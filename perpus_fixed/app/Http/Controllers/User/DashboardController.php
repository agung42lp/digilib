<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\{Book, Category};
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if ($request->search) {
            return redirect()->route('user.books.index', ['search' => $request->search]);
        }

        $categories         = Category::withCount('books')->get();
        $trendingBooks      = Book::orderBy('borrowed_count', 'desc')->where('stock', '>', 0)->take(8)->get();
        $newBooks           = Book::latest()->take(8)->get();
        $topBooks           = Book::orderBy('borrowed_count', 'desc')->take(10)->get();
        $featuredCategories = Category::withCount('books')->take(6)->get();

        return view('user.dashboard', compact(
            'categories', 'trendingBooks', 'newBooks', 'topBooks', 'featuredCategories'
        ));
    }
}