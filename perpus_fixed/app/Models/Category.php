<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'icon', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    // Scope: hanya kategori aktif (dipakai di form buku & proposal)
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
