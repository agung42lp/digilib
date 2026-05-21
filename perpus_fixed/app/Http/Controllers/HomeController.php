<?php

namespace App\Http\Controllers;

use App\Models\{Book, Category};

class HomeController extends Controller
{
    public function index()
    {
        // Redirect user yang sudah login ke dashboard masing-masing
        if (auth()->check()) {
            return auth()->user()->isPetugas()
                ? redirect()->route('admin.dashboard')
                : redirect()->route('user.dashboard');
        }

        $trendingBooks = Book::with('category')
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->orderByDesc('borrowed_count')
            ->limit(8)->get();

        $newBooks = Book::with('category')
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->latest()
            ->limit(8)->get();

        $topBooks = Book::with('category')
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->orderByDesc('reviews_avg_rating')
            ->limit(10)->get();

        return view('welcome', compact('trendingBooks', 'newBooks', 'topBooks'));
    }
}
