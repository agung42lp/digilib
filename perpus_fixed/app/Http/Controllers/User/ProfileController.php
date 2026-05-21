<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\{Borrowing, Collection};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $borrowings = Borrowing::with(['book', 'review'])
            ->where('user_id', $user->id)
            ->latest()->get();

        $collections = Collection::with('book')
            ->where('user_id', $user->id)->get();

        $reviews = $user->reviews()->with('book')->latest()->get();

        // Buku yang sudah dikembalikan tapi belum diberi ulasan — tampilkan review prompt otomatis
        $pendingReviews = $borrowings->where('status', 'returned')
            ->filter(fn($b) => is_null($b->review));

        return view('user.profile.index',
            compact('user', 'borrowings', 'collections', 'reviews', 'pendingReviews'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $data = $request->validate([
            'name'   => 'required|string|max:255',
            'phone'  => 'nullable|string|max:20',
            'city'   => 'nullable|string|max:100',   // FIX: was required → nullable
            'avatar' => 'nullable|image|max:1024',
        ]);
        if ($request->hasFile('avatar')) {
            if ($user->avatar) Storage::disk('public')->delete($user->avatar);
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }
        $user->update($data);
        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:6|confirmed',
        ]);
        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah!'])->withInput();
        }
        auth()->user()->update(['password' => Hash::make($request->password)]);
        return back()->with('success', 'Password berhasil diubah!');
    }
}
