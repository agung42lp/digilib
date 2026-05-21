<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Book, Borrowing, Category, Review, User};

class DashboardController extends Controller
{
    public function index()
    {
        $user  = auth()->user();
        $isAdmin = $user->isAdmin();

        $stats = [
            'total_books'       => Book::count(),
            'total_users'       => User::where('role', 'user')->count(),
            'total_borrowings'  => Borrowing::count(),
            'active_borrowings' => Borrowing::whereIn('status', ['approved', 'returning'])->count(),
            'pending_borrow'    => Borrowing::where('status', 'pending')->count(),
            'pending_return'    => Borrowing::where('status', 'returning')->count(),
            'overdue'           => Borrowing::where('status', 'approved')
                                        ->where('return_date', '<', now())->count(),
            'total_categories'  => Category::count(),
            'total_reviews'     => Review::count(),
            'returned_this_month' => Borrowing::where('status', 'returned')
                                        ->whereMonth('updated_at', now()->month)
                                        ->whereYear('updated_at', now()->year)->count(),
        ];;

        $recentBorrowings = Borrowing::with(['user', 'book'])
            ->latest()->take(6)->get();

        $popularBooks = Book::withCount('borrowings as borrow_count')
            ->orderByDesc('borrow_count')->take(5)->get();

        // Weekly bar chart — last 16 weeks
        $weeklyBorrowed  = [];
        $weeklyReturned  = [];
        $weeklyLabels    = [];
        for ($w = 15; $w >= 0; $w--) {
            $start = now()->startOfWeek()->subWeeks($w);
            $end   = (clone $start)->endOfWeek();
            $weeklyBorrowed[]  = Borrowing::whereBetween('created_at', [$start, $end])->count();
            $weeklyReturned[]  = Borrowing::where('status','returned')->whereBetween('updated_at', [$start, $end])->count();
            $weeklyLabels[]    = 'Mg ' . (16 - $w);
        }

        // Donut — top 4 categories + Lainnya
        $catCounts = Category::withCount('books')->orderByDesc('books_count')->take(4)->get();
        $topTotal  = $catCounts->sum('books_count');
        $allBooks  = max(1, Book::count());
        $donutData = $catCounts->map(fn($c) => [
            'name'  => $c->name,
            'count' => $c->books_count,
            'pct'   => round($c->books_count / $allBooks * 100),
        ])->toArray();
        $otherPct = max(0, 100 - array_sum(array_column($donutData,'pct')));
        if ($otherPct > 0) $donutData[] = ['name'=>'Lainnya','count'=>$allBooks-$topTotal,'pct'=>$otherPct];

        return view('admin.dashboard', compact(
            'stats','recentBorrowings','popularBooks',
            'weeklyBorrowed','weeklyReturned','weeklyLabels','donutData','isAdmin'
        ));
    }
}
