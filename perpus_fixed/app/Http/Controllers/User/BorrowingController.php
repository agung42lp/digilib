<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\{Borrowing, Book, Review};
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function create(Request $request)
    {
        $book = Book::with('category')->findOrFail($request->book_id);
        abort_if(!$book->isAvailable(), 403, 'Buku tidak tersedia.');
        return view('user.borrowings.create', compact('book'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id'     => 'required|exists:books,id',
            'borrow_date' => 'required|date|after_or_equal:today',
            'return_date' => 'required|date|after:borrow_date',
        ]);

        $book = Book::findOrFail($request->book_id);
        $user = auth()->user();

        if (!$user->is_active) {
            return back()->with('error', 'Akun Anda belum diaktifkan. Silakan tunggu konfirmasi dari admin.');
        }

        $activeCount = Borrowing::where('user_id', $user->id)
            ->whereNotIn('status', ['returned', 'rejected'])->count();

        if ($activeCount >= 3) {
            return back()->with('error', 'Anda sudah memiliki 3 peminjaman aktif. Kembalikan buku terlebih dahulu.');
        }

        $activeSame = Borrowing::where('user_id', $user->id)
            ->where('book_id', $book->id)
            ->whereNotIn('status', ['returned', 'rejected'])->exists();

        if ($activeSame) {
            return back()->with('error', 'Anda masih memiliki peminjaman aktif untuk buku ini!');
        }

        if (!$book->isAvailable()) {
            return back()->with('error', 'Buku sedang tidak tersedia!');
        }

        Borrowing::create([
            'user_id'     => $user->id,
            'book_id'     => $book->id,
            'borrow_date' => $request->borrow_date,
            'return_date' => $request->return_date,
            'condition'   => 'normal',
            'status'      => 'pending',
            'user_note'   => $request->notes,
        ]);

        return redirect()
            ->route('user.borrow.create', ['book_id' => $book->id])
            ->with('success', true);
    }

    // FIX: accept Request to capture user_note from form
    public function submitReturn(Request $request, Borrowing $borrowing)
    {
        if ($borrowing->user_id !== auth()->id() || $borrowing->status !== 'approved') {
            return back()->with('error', 'Tidak dapat mengajukan pengembalian!');
        }
        $borrowing->update([
            'status'    => 'returning',
            'user_note' => $request->notes,
        ]);
        return back()->with('success', 'Pengajuan pengembalian berhasil dikirim! Menunggu konfirmasi petugas.');
    }

    public function storeReview(Request $request, Borrowing $borrowing)
    {
        $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        if ($borrowing->user_id !== auth()->id() || $borrowing->status !== 'returned') {
            return back()->with('error', 'Tidak dapat memberikan ulasan!');
        }

        if ($borrowing->review) {
            return back()->with('error', 'Anda sudah memberikan ulasan untuk buku ini!');
        }

        Review::create([
            'borrowing_id' => $borrowing->id,
            'user_id'      => auth()->id(),
            'book_id'      => $borrowing->book_id,
            'rating'       => $request->rating,
            'comment'      => $request->comment,
        ]);

        return back()->with('success', 'Ulasan berhasil dikirim! Terima kasih.');
    }

    public function printBorrowReceipt(Borrowing $borrowing)
    {
        if ($borrowing->user_id !== auth()->id()) abort(403);
        // Boleh cetak selama buku belum dikembalikan atau sudah disetujui setidaknya
        abort_if(
            !in_array($borrowing->status, ['approved','returning','returned']),
            403,
            'Bukti peminjaman hanya tersedia setelah disetujui admin.'
        );
        return view('user.borrowings.receipt', compact('borrowing'));
    }

    public function printReturnReceipt(Borrowing $borrowing)
    {
        if ($borrowing->user_id !== auth()->id()) abort(403);
        // FIX: hanya boleh cetak bukti kembali jika buku sudah benar-benar dikembalikan
        abort_if(
            $borrowing->status !== 'returned',
            403,
            'Bukti pengembalian hanya tersedia setelah pengembalian disetujui petugas.'
        );
        return view('user.borrowings.return-receipt', compact('borrowing'));
    }
}
