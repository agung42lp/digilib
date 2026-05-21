<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'username', 'email', 'password',
        'phone', 'city', 'role', 'avatar', 'is_active',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
        'is_active'         => 'boolean',
    ];

    public function isAdmin(): bool    { return $this->role === 'admin'; }
    public function isPetugas(): bool  { return in_array($this->role, ['admin', 'petugas']); }

    public function borrowings()   { return $this->hasMany(Borrowing::class); }
    public function reviews()      { return $this->hasMany(Review::class); }
    public function collections()  { return $this->hasMany(Collection::class); }

    /** Semua peminjaman aktif user (bisa lebih dari satu) */
    public function activeBorrowings()
    {
        return $this->borrowings()
            ->whereNotIn('status', ['returned', 'rejected']);
    }

    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        }
        $initials = implode('+', array_map(fn($w) => mb_substr($w, 0, 1), explode(' ', $this->name)));
        return 'https://placehold.co/80x80/1c6b46/ffffff?text=' . $initials;
    }
}
