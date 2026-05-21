<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Book, Borrowing, User, Review, Category};
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }

    public function books(Request $request)
    {
        $categories = Category::all();
        $books = Book::with('category')
            ->when($request->category_id, fn($q) => $q->where('category_id', $request->category_id))
            ->orderBy('title')
            ->get();

        if ($request->format === 'csv') {
            return $this->exportBooksCsv($books);
        }

        if ($request->format === 'pdf') {
            return $this->exportBooksPdf($books);
        }

        return view('admin.reports.books', compact('books', 'categories'));
    }

    public function borrowings(Request $request)
    {
        $borrowings = Borrowing::with(['user', 'book'])
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->from, fn($q) => $q->where('borrow_date', '>=', $request->from))
            ->when($request->to, fn($q) => $q->where('borrow_date', '<=', $request->to))
            ->latest()->get();

        if ($request->format === 'csv') {
            return $this->exportBorrowingsCsv($borrowings);
        }

        if ($request->format === 'pdf') {
            return $this->exportBorrowingsPdf($borrowings);
        }

        return view('admin.reports.borrowings', compact('borrowings'));
    }

    public function users(Request $request)
    {
        $users = User::where('role', 'user')
            ->withCount('borrowings')
            ->orderBy('name')
            ->get();

        if ($request->format === 'csv') {
            return $this->exportUsersCsv($users);
        }

        if ($request->format === 'pdf') {
            return $this->exportUsersPdf($users);
        }

        return view('admin.reports.users', compact('users'));
    }

    /* ── CSV Exports ── */

    private function exportBooksCsv($books)
    {
        $filename = 'laporan-buku-' . date('Ymd') . '.csv';
        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];
        $callback = function () use ($books) {
            $handle = fopen('php://output', 'w');
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF)); // UTF-8 BOM for Excel
            fputcsv($handle, ['No', 'Judul', 'Penulis', 'Penerbit', 'Kategori', 'ISBN', 'Stok', 'Dipinjam', 'Rating']);
            foreach ($books as $i => $b) {
                fputcsv($handle, [
                    $i + 1,
                    $b->title,
                    $b->author,
                    $b->publisher,
                    $b->category->name ?? '-',
                    $b->isbn ?? '-',
                    $b->stock,
                    $b->borrowed_count,
                    number_format($b->avgRating(), 1),
                ]);
            }
            fclose($handle);
        };
        return response()->stream($callback, 200, $headers);
    }

    private function exportBorrowingsCsv($borrowings)
    {
        $filename = 'laporan-peminjaman-' . date('Ymd') . '.csv';
        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];
        $callback = function () use ($borrowings) {
            $handle = fopen('php://output', 'w');
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));
            fputcsv($handle, ['No', 'Peminjam', 'Email', 'Buku', 'Tgl Pinjam', 'Tgl Kembali', 'Tgl Aktual', 'Status', 'Denda']);
            foreach ($borrowings as $i => $b) {
                fputcsv($handle, [
                    $i + 1,
                    $b->user->name,
                    $b->user->email,
                    $b->book->title,
                    $b->borrow_date->format('d/m/Y'),
                    $b->return_date->format('d/m/Y'),
                    $b->actual_return_date ? $b->actual_return_date->format('d/m/Y') : '-',
                    $b->status_label,
                    $b->fine_amount > 0 ? 'Rp ' . number_format($b->fine_amount, 0, ',', '.') : '-',
                ]);
            }
            fclose($handle);
        };
        return response()->stream($callback, 200, $headers);
    }

    private function exportUsersCsv($users)
    {
        $filename = 'laporan-user-' . date('Ymd') . '.csv';
        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];
        $callback = function () use ($users) {
            $handle = fopen('php://output', 'w');
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));
            fputcsv($handle, ['No', 'Nama', 'Username', 'Email', 'No HP', 'Kota', 'Status', 'Total Pinjam']);
            foreach ($users as $i => $u) {
                fputcsv($handle, [
                    $i + 1,
                    $u->name,
                    $u->username,
                    $u->email,
                    $u->phone ?? '-',
                    $u->city ?? '-',
                    $u->is_active ? 'Aktif' : 'Nonaktif',
                    $u->borrowings_count,
                ]);
            }
            fclose($handle);
        };
        return response()->stream($callback, 200, $headers);
    }

    /* ── PDF Exports (menggunakan view HTML → print) ── */

    public function staff(Request $request)
    {
        abort_if(!auth()->user()->isAdmin(), 403, 'Hanya admin yang dapat mengakses laporan petugas.');

        $staff = User::whereIn('role', ['admin', 'petugas'])
            ->withCount(['borrowings as handled_borrowings' => fn($q) => $q])
            ->orderBy('role')->orderBy('name')
            ->get();

        // Tambah proposal count
        foreach ($staff as $s) {
            $s->proposals_count = \App\Models\BookProposal::where('user_id', $s->id)->count();
            $s->proposals_approved = \App\Models\BookProposal::where('user_id', $s->id)->where('status','approved')->count();
        }

        if ($request->format === 'csv') {
            return $this->exportStaffCsv($staff);
        }

        if ($request->format === 'pdf') {
            return $this->exportStaffPdf($staff);
        }

        return view('admin.reports.staff', compact('staff'));
    }

    private function exportStaffCsv($staff)
    {
        $filename = 'laporan-petugas-' . date('Ymd') . '.csv';
        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];
        $callback = function () use ($staff) {
            $handle = fopen('php://output', 'w');
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));
            fputcsv($handle, ['No', 'Nama', 'Username', 'Email', 'No HP', 'Kota', 'Role', 'Total Usulan', 'Usulan Diterima', 'Bergabung']);
            foreach ($staff as $i => $s) {
                fputcsv($handle, [
                    $i + 1, $s->name, $s->username, $s->email,
                    $s->phone ?? '-', $s->city ?? '-',
                    ucfirst($s->role),
                    $s->proposals_count,
                    $s->proposals_approved,
                    $s->created_at->format('d/m/Y'),
                ]);
            }
            fclose($handle);
        };
        return response()->stream($callback, 200, $headers);
    }

    private function exportStaffPdf($staff)
    {
        if (class_exists(\Barryvdh\DomPDF\Facade\Pdf::class)) {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.reports.pdf.staff', compact('staff'));
            return $pdf->download('laporan-petugas-' . date('Ymd') . '.pdf');
        }
        return view('admin.reports.pdf.staff', compact('staff'));
    }

    private function exportBooksPdf($books)
    {
        if (class_exists(\Barryvdh\DomPDF\Facade\Pdf::class)) {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.reports.pdf.books', compact('books'));
            return $pdf->download('laporan-buku-' . date('Ymd') . '.pdf');
        }
        // Fallback: tampilkan print view
        return view('admin.reports.pdf.books', compact('books'));
    }

    private function exportBorrowingsPdf($borrowings)
    {
        if (class_exists(\Barryvdh\DomPDF\Facade\Pdf::class)) {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.reports.pdf.borrowings', compact('borrowings'));
            return $pdf->download('laporan-peminjaman-' . date('Ymd') . '.pdf');
        }
        return view('admin.reports.pdf.borrowings', compact('borrowings'));
    }

    private function exportUsersPdf($users)
    {
        if (class_exists(\Barryvdh\DomPDF\Facade\Pdf::class)) {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.reports.pdf.users', compact('users'));
            return $pdf->download('laporan-user-' . date('Ymd') . '.pdf');
        }
        return view('admin.reports.pdf.users', compact('users'));
    }
}
