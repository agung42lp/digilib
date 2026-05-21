<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Review;

class ReviewController extends Controller
{
    public function destroy(Review $review)
    {
        if ($review->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki izin menghapus ulasan ini.');
        }
        $review->delete();
        return back()->with('success', 'Ulasan berhasil dihapus.');
    }
}
