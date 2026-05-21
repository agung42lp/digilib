<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->get('role', 'user');

        $users = User::where('role', $role)
            ->when($request->search, fn($q) => $q
                ->where('name', 'like', "%{$request->search}%")
                ->orWhere('email', 'like', "%{$request->search}%")
                ->orWhere('username', 'like', "%{$request->search}%")
            )
            ->when($request->status === 'aktif',    fn($q) => $q->where('is_active', true))
            ->when($request->status === 'nonaktif', fn($q) => $q->where('is_active', false))
            ->latest()
            ->paginate(15);

        $stats = [
            'total_user'    => User::where('role', 'user')->count(),
            'aktif'         => User::where('role', 'user')->where('is_active', true)->count(),
            'nonaktif'      => User::where('role', 'user')->where('is_active', false)->count(),
            'total_petugas' => User::whereIn('role', ['admin', 'petugas'])->count(),
        ];

        $counts = [
            'user'    => User::where('role', 'user')->count(),
            'petugas' => User::where('role', 'petugas')->count(),
            'admin'   => User::where('role', 'admin')->count(),
        ];

        return view('admin.users.index', compact('users', 'role', 'stats', 'counts'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|unique:users',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phone'    => 'nullable|string',
            'city'     => 'nullable|string',
            'role'     => 'required|in:admin,petugas,user',
        ]);
        $data['password']  = Hash::make($data['password']);
        $data['is_active'] = true; // Akun yang dibuat admin langsung aktif
        User::create($data);
        return back()->with('success', 'Akun berhasil ditambahkan!');
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|unique:users,username,' . $user->id,
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'phone'    => 'nullable|string',
            'city'     => 'nullable|string',
        ]);
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }
        $user->update($data);
        return back()->with('success', 'Akun berhasil diperbarui!');
    }

    /**
     * Toggle is_active status — aktifkan atau nonaktifkan akun user.
     * Hanya admin yang bisa mengakses (dijaga di middleware + route).
     */
    public function activate(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak dapat mengubah status akun sendiri!');
        }

        $user->update(['is_active' => !$user->is_active]);

        $status = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return back()->with('success', "Akun {$user->name} berhasil {$status}.");
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak dapat menghapus akun sendiri!');
        }
        $user->delete();
        return back()->with('success', 'Akun berhasil dihapus!');
    }
}
