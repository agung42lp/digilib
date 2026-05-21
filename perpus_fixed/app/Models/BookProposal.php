<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookProposal extends Model
{
    protected $fillable = [
        'user_id', 'category_id', 'title', 'author', 'publisher',
        'publish_year', 'isbn', 'synopsis', 'reason', 'cover',
        'status', 'reviewed_by', 'admin_note', 'reviewed_at',
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
    ];

    // ── Relationships ─────────────────────────────────────────────────────────
    public function user()       { return $this->belongsTo(User::class); }
    public function category()   { return $this->belongsTo(Category::class); }
    public function reviewer()   { return $this->belongsTo(User::class, 'reviewed_by'); }

    // ── Scopes ────────────────────────────────────────────────────────────────
    public function scopePending($q)  { return $q->where('status', 'pending'); }
    public function scopeApproved($q) { return $q->where('status', 'approved'); }
    public function scopeRejected($q) { return $q->where('status', 'rejected'); }

    // ── Computed ──────────────────────────────────────────────────────────────
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending'  => 'Menunggu',
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            default    => $this->status,
        };
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'pending'  => 'bdg-a',
            'approved' => 'bdg-g',
            'rejected' => 'bdg-r',
            default    => 'bdg-m',
        };
    }

    public function isPending(): bool  { return $this->status === 'pending'; }
    public function isApproved(): bool { return $this->status === 'approved'; }
    public function isRejected(): bool { return $this->status === 'rejected'; }
}
