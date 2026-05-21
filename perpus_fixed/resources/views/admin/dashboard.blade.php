@extends('layouts.admin')
@section('title','Dashboard')
@section('page-title','Dashboard')
@section('page-subtitle', 'Selamat datang, ' . auth()->user()->name)

@push('styles')
<style>
/* ── KPI STAT CARDS ── */
.stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:14px}
.stat-card{
  background:var(--white);border:1px solid var(--border);border-radius:14px;
  padding:18px 20px;position:relative;overflow:hidden;
  display:flex;flex-direction:column;gap:0;
}
.stat-card::before{
  content:'';position:absolute;top:0;left:0;right:0;
  height:3px;background:var(--card-accent,var(--border));border-radius:14px 14px 0 0;
}
.stat-card.accent-green{--card-accent:var(--green)}
.stat-card.accent-red{--card-accent:var(--red)}
.stat-card.accent-amber{--card-accent:var(--amber)}
.stat-card.accent-blue{--card-accent:var(--blue)}
.stat-icon-row{display:flex;align-items:center;justify-content:space-between;margin-bottom:14px}
.stat-icon{width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.stat-icon.green{background:var(--green-pale);color:var(--green)}
.stat-icon.red{background:var(--red-pale);color:var(--red)}
.stat-icon.amber{background:var(--amber-pale);color:var(--amber)}
.stat-icon.blue{background:var(--blue-pale);color:var(--blue)}
.stat-trend{display:flex;align-items:center;gap:4px;font-family:'Syne',sans-serif;font-size:.55rem;font-weight:700;padding:3px 7px;border-radius:99px}
.stat-trend.up{background:var(--green-pale);color:var(--green)}
.stat-trend.down{background:var(--red-pale);color:var(--red)}
.stat-trend.neutral{background:var(--surface);color:var(--muted-2)}
.stat-label{font-family:'Syne',sans-serif;font-size:.57rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--muted-2);margin-bottom:4px}
.stat-num{font-family:'Instrument Serif',serif;font-size:2.1rem;color:var(--ink);letter-spacing:-.04em;line-height:1}
.stat-num.green{color:var(--green)}
.stat-num.red{color:var(--red)}
.stat-num.amber{color:var(--amber)}
.stat-num.blue{color:var(--blue)}
.stat-sub{font-size:.67rem;color:var(--muted-2);margin-top:4px}
.stat-sparkline{margin-top:14px;height:36px;position:relative}

/* ── CHARTS ── */
.charts-row{display:grid;grid-template-columns:1.6fr 1fr;gap:14px}
.chart-card{background:var(--white);border:1px solid var(--border);border-radius:14px;overflow:hidden}
.chart-card-head{padding:16px 20px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between}
.chart-card-title{font-family:'Syne',sans-serif;font-size:.65rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--muted)}
.chart-card-body{padding:20px}
.chart-legend{display:flex;align-items:center;gap:14px}
.legend-item{display:flex;align-items:center;gap:6px;font-size:.7rem;color:var(--muted)}
.legend-dot{width:8px;height:8px;border-radius:50%}
.chart-stats-row{display:grid;grid-template-columns:repeat(3,1fr);gap:8px;margin-top:16px}
.chart-mini-stat{padding:10px 12px;background:var(--surface);border-radius:9px;border:1px solid var(--border)}
.cms-val{font-family:'Instrument Serif',serif;font-size:1.4rem;letter-spacing:-.04em;line-height:1}
.cms-lbl{font-family:'Syne',sans-serif;font-size:.51rem;font-weight:700;letter-spacing:.05em;text-transform:uppercase;color:var(--muted-2);margin-top:2px}
.donut-legend{display:flex;flex-direction:column;gap:8px;margin-top:4px}
.dl-item{display:flex;align-items:center;gap:8px;font-size:.75rem;color:var(--ink-2)}
.dl-bar-wrap{flex:1;height:4px;background:var(--surface);border-radius:2px;overflow:hidden}
.dl-bar{height:100%;border-radius:2px}
.dl-pct{font-family:'Syne',sans-serif;font-size:.6rem;font-weight:700;color:var(--muted-2);min-width:30px;text-align:right}
.dl-dot{width:8px;height:8px;border-radius:2px;flex-shrink:0}

/* ── BOTTOM ROW ── */
.bottom-row{display:grid;grid-template-columns:1fr 1fr 1.1fr;gap:14px}
.recent-row{display:flex;align-items:center;gap:10px;padding:9px 0;border-bottom:1px solid var(--border)}
.recent-row:last-child{border-bottom:none}
.recent-av{width:28px;height:28px;border-radius:50%;background:var(--green-pale);color:var(--green);display:flex;align-items:center;justify-content:center;font-size:.58rem;font-weight:700;flex-shrink:0}
.recent-name{font-size:.78rem;font-weight:500;color:var(--ink)}
.recent-sub{font-size:.67rem;color:var(--muted-2)}
.recent-date{font-size:.68rem;color:var(--muted-2);margin-left:auto;white-space:nowrap}
.activity-item{display:flex;gap:10px;padding:9px 0;border-bottom:1px solid var(--border)}
.activity-item:last-child{border-bottom:none}
.act-icon-wrap{width:28px;height:28px;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.act-icon-wrap.green{background:var(--green-pale);color:var(--green)}
.act-icon-wrap.red{background:var(--red-pale);color:var(--red)}
.act-icon-wrap.amber{background:var(--amber-pale);color:var(--amber)}
.act-icon-wrap.blue{background:var(--blue-pale);color:var(--blue)}
.act-text{font-size:.77rem;color:var(--ink-2);line-height:1.45;flex:1}
.act-text strong{font-weight:600;color:var(--ink)}
.act-time{font-size:.63rem;color:var(--muted-2);white-space:nowrap;margin-top:1px}
.top-book-item{display:flex;align-items:center;gap:10px;padding:8px 0;border-bottom:1px solid var(--border)}
.top-book-item:last-child{border-bottom:none}
.tb-rank{font-family:'Instrument Serif',serif;font-size:1.1rem;color:var(--muted-2);width:20px;text-align:center;flex-shrink:0}
.tb-rank.top{color:var(--amber)}
.tb-cover{width:30px;height:42px;border-radius:5px;flex-shrink:0;box-shadow:0 2px 6px rgba(0,0,0,.12);overflow:hidden;object-fit:cover}
.tb-title{font-size:.78rem;font-weight:500;color:var(--ink);line-height:1.3}
.tb-author{font-size:.66rem;color:var(--muted-2)}
.tb-count{margin-left:auto;font-family:'Syne',sans-serif;font-size:.6rem;font-weight:700;color:var(--green);background:var(--green-pale);padding:3px 8px;border-radius:5px;flex-shrink:0}
.alert-bar{display:flex;align-items:center;gap:10px;background:var(--red-pale);border:1px solid rgba(192,57,43,.2);border-radius:10px;padding:11px 16px;font-size:.77rem;color:#8b2219}
.alert-bar strong{font-weight:600}
.alert-bar-icon{flex-shrink:0;color:var(--red)}
.see-all{font-size:.65rem;color:var(--green);font-weight:600}
.card-body{padding:14px 18px}

/* PETUGAS SIMPLE DASHBOARD */
.two-col{display:grid;grid-template-columns:1fr 1fr;gap:14px}
</style>
@endpush

@section('content')
@php
  $overdue = $stats['overdue'] ?? 0;
  $pending = $stats['pending_borrow'] ?? 0;
  $colors  = ['#1c6b46','#1a5280','#b8760a','#7b3fa0','#c0392b'];
@endphp

@if($isAdmin)
{{-- ══════════════ ADMIN FULL DASHBOARD ══════════════ --}}

{{-- Alert Banner --}}
@if($overdue > 0)
<div class="alert-bar" style="margin-bottom:0">
  <div class="alert-bar-icon">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
  </div>
  <div><strong>{{ $overdue }} peminjaman terlambat</strong> belum dikembalikan.
    <a href="{{ route('admin.borrowings.index', ['status'=>'approved','overdue'=>1]) }}" style="text-decoration:underline;color:inherit">Lihat detail →</a>
  </div>
  <div style="margin-left:auto;font-family:'Syne',sans-serif;font-size:.55rem;font-weight:700;letter-spacing:.05em;text-transform:uppercase;color:var(--red);opacity:.7">Perlu Tindakan</div>
</div>
@endif

{{-- KPI CARDS --}}
<div class="stats-grid">
  {{-- Total Buku --}}
  <div class="stat-card accent-green">
    <div class="stat-icon-row">
      <div class="stat-icon green">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
      </div>
      <span class="stat-trend up">{{ $stats['total_books'] }} judul</span>
    </div>
    <div class="stat-label">Total Buku</div>
    <div class="stat-num green">{{ number_format($stats['total_books']) }}</div>
    <div class="stat-sub">{{ $stats['total_categories'] }} kategori tersedia</div>
    <div class="stat-sparkline"><canvas id="sparkline1"></canvas></div>
  </div>

  {{-- Dipinjam Aktif --}}
  <div class="stat-card accent-blue">
    <div class="stat-icon-row">
      <div class="stat-icon blue">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><polyline points="23 4 23 10 17 10"/><polyline points="1 20 1 14 7 14"/><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/></svg>
      </div>
      @if($pending > 0)<span class="stat-trend neutral">+{{ $pending }} pending</span>@endif
    </div>
    <div class="stat-label">Dipinjam Aktif</div>
    <div class="stat-num blue">{{ number_format($stats['active_borrowings']) }}</div>
    <div class="stat-sub">{{ $stats['returned_this_month'] }} dikembalikan bulan ini</div>
    <div class="stat-sparkline"><canvas id="sparkline2"></canvas></div>
  </div>

  {{-- Terlambat --}}
  <div class="stat-card accent-red">
    <div class="stat-icon-row">
      <div class="stat-icon red">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
      </div>
      @if($overdue > 0)<span class="stat-trend down">⚠ Lewat jatuh tempo</span>@else<span class="stat-trend up">✓ Tidak ada</span>@endif
    </div>
    <div class="stat-label">Terlambat Kembali</div>
    <div class="stat-num {{ $overdue > 0 ? 'red' : '' }}">{{ $overdue }}</div>
    <div class="stat-sub">Perlu tindak lanjut segera</div>
    <div class="stat-sparkline"><canvas id="sparkline3"></canvas></div>
  </div>

  {{-- Anggota --}}
  <div class="stat-card accent-amber">
    <div class="stat-icon-row">
      <div class="stat-icon amber">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
      </div>
      <span class="stat-trend up">Anggota aktif</span>
    </div>
    <div class="stat-label">Total Anggota</div>
    <div class="stat-num amber">{{ number_format($stats['total_users']) }}</div>
    <div class="stat-sub">{{ $stats['total_reviews'] }} ulasan ditulis</div>
    <div class="stat-sparkline"><canvas id="sparkline4"></canvas></div>
  </div>
</div>

{{-- CHARTS ROW --}}
<div class="charts-row">
  {{-- Bar Chart --}}
  <div class="chart-card">
    <div class="chart-card-head">
      <span class="chart-card-title">Aktivitas Peminjaman</span>
      <div class="chart-legend">
        <div class="legend-item"><div class="legend-dot" style="background:#1c6b46"></div>Dipinjam</div>
        <div class="legend-item"><div class="legend-dot" style="background:#c9c5ba"></div>Dikembalikan</div>
      </div>
    </div>
    <div class="chart-card-body">
      <canvas id="barChart" height="120"></canvas>
      <div class="chart-stats-row">
        <div class="chart-mini-stat">
          <div class="cms-val" style="color:var(--green)">{{ number_format($stats['total_borrowings']) }}</div>
          <div class="cms-lbl">Total Pinjam</div>
        </div>
        <div class="chart-mini-stat">
          <div class="cms-val" style="color:var(--blue)">{{ number_format($stats['active_borrowings']) }}</div>
          <div class="cms-lbl">Aktif</div>
        </div>
        <div class="chart-mini-stat">
          <div class="cms-val" style="color:var(--amber)">{{ number_format($stats['returned_this_month']) }}</div>
          <div class="cms-lbl">Kembali Bln Ini</div>
        </div>
      </div>
    </div>
  </div>

  {{-- Donut Chart --}}
  <div class="chart-card">
    <div class="chart-card-head">
      <span class="chart-card-title">Distribusi Kategori</span>
    </div>
    <div class="chart-card-body" style="display:flex;gap:20px;align-items:center">
      <canvas id="donutChart" width="130" height="130" style="flex-shrink:0"></canvas>
      <div class="donut-legend" style="flex:1">
        @foreach($donutData as $i => $cat)
        <div class="dl-item">
          <div class="dl-dot" style="background:{{ $colors[$i % count($colors)] }}"></div>
          <span style="flex:1;font-size:.72rem;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ $cat['name'] }}</span>
          <div class="dl-bar-wrap">
            <div class="dl-bar" style="width:{{ $cat['pct'] }}%;background:{{ $colors[$i % count($colors)] }}"></div>
          </div>
          <span class="dl-pct">{{ $cat['pct'] }}%</span>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>

{{-- BOTTOM ROW --}}
<div class="bottom-row">

  {{-- Peminjaman Terkini --}}
  <div class="card">
    <div class="card-head">
      Peminjaman Terkini
      <a href="{{ route('admin.borrowings.index') }}" class="see-all">Lihat semua →</a>
    </div>
    <div class="card-body">
      @forelse($recentBorrowings as $b)
      <div class="recent-row">
        <div class="recent-av" style="{{ $b->status==='approved'?'background:var(--green-pale);color:var(--green)':($b->status==='returning'?'background:var(--amber-pale);color:var(--amber)':'') }}">
          {{ strtoupper(substr($b->user->name ?? 'XX', 0, 2)) }}
        </div>
        <div style="min-width:0">
          <div class="recent-name">{{ $b->user->name ?? '-' }}</div>
          <div class="recent-sub" style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap">
            {{ Str::limit($b->book->title ?? '-', 22) }} ·
            @if($b->isLate()) Terlambat {{ $b->lateDays() }}h
            @elseif($b->status==='returning') Proses kembali
            @elseif($b->status==='pending') Menunggu konfirmasi
            @else Sisa {{ max(0,(int)now()->diffInDays($b->return_date, false)) }} hari
            @endif
          </div>
        </div>
        <div class="recent-date">
          @if($b->isLate())
            <span class="badge badge-red">Terlambat</span>
          @elseif($b->status==='pending')
            <span class="badge badge-blue">Pending</span>
          @elseif($b->status==='returning')
            <span class="badge badge-amber">Kembali</span>
          @elseif($b->status==='approved')
            <span class="badge badge-green">Aktif</span>
          @else
            <span class="badge badge-muted">Selesai</span>
          @endif
        </div>
      </div>
      @empty
      <div style="text-align:center;padding:30px 0;color:var(--muted-2);font-size:.8rem">Belum ada peminjaman</div>
      @endforelse
    </div>
  </div>

  {{-- Log Aktivitas --}}
  <div class="card">
    <div class="card-head">
      Log Aktivitas
    </div>
    <div class="card-body">
      @forelse($recentBorrowings->take(5) as $b)
      @php
        $icon = match($b->status) {
          'approved'  => ['green','<polyline points="20 6 9 17 4 12"/>'],
          'returning' => ['amber','<polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.5"/>'],
          'returned'  => ['green','<polyline points="20 6 9 17 4 12"/>'],
          'rejected'  => ['red','<polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/>'],
          default     => ['blue','<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>'],
        };
        $action = match($b->status) {
          'approved'  => 'Peminjaman disetujui',
          'returning' => 'Pengajuan pengembalian',
          'returned'  => 'Pengembalian dikonfirmasi',
          'rejected'  => 'Pengajuan ditolak',
          default     => 'Permintaan baru masuk',
        };
      @endphp
      <div class="activity-item">
        <div class="act-icon-wrap {{ $icon[0] }}">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">{!! $icon[1] !!}</svg>
        </div>
        <div style="flex:1;min-width:0">
          <div class="act-text"><strong>{{ $action }}</strong> — "{{ Str::limit($b->book->title ?? '-', 25) }}" oleh {{ $b->user->name ?? '-' }}</div>
          <div class="act-time">{{ $b->updated_at->diffForHumans() }}</div>
        </div>
      </div>
      @empty
      <div style="text-align:center;padding:30px 0;color:var(--muted-2);font-size:.8rem">Belum ada aktivitas</div>
      @endforelse
    </div>
  </div>

  {{-- Buku Terpopuler --}}
  <div class="card">
    <div class="card-head">
      Buku Terpopuler
      <a href="{{ route('admin.books.index') }}" class="see-all">Lihat semua →</a>
    </div>
    <div class="card-body">
      @forelse($popularBooks as $i => $book)
      @php
        $grad = ['linear-gradient(135deg,#1c6b46,#0b3021)','linear-gradient(135deg,#1a5280,#0d2e4a)','linear-gradient(135deg,#b8760a,#6b4406)','linear-gradient(135deg,#7b3fa0,#3d1a55)','linear-gradient(135deg,#c0392b,#6b1d14)'];
      @endphp
      <div class="top-book-item">
        <div class="tb-rank {{ $i < 3 ? 'top' : '' }}">{{ $i+1 }}</div>
        @if($book->cover)
          <img src="{{ asset('storage/'.$book->cover) }}" class="tb-cover" alt="{{ $book->title }}">
        @else
          <div class="tb-cover" style="background:{{ $grad[$i % 5] }}"></div>
        @endif
        <div style="flex:1;min-width:0">
          <div class="tb-title">{{ Str::limit($book->title, 28) }}</div>
          <div class="tb-author">{{ Str::limit($book->author, 24) }}</div>
        </div>
        <div class="tb-count">{{ $book->borrow_count ?? 0 }}×</div>
      </div>
      @empty
      <div style="text-align:center;padding:30px 0;color:var(--muted-2);font-size:.8rem">Belum ada data</div>
      @endforelse
    </div>
  </div>

</div>{{-- /bottom-row --}}

@else
{{-- ══ PETUGAS SIMPLE DASHBOARD ══ --}}
<div class="stats-grid" style="grid-template-columns:repeat(3,1fr)">
  <div class="stat-card accent-green">
    <div class="stat-icon-row"><div class="stat-icon green"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg></div></div>
    <div class="stat-label">Total Buku</div>
    <div class="stat-num green">{{ number_format($stats['total_books']) }}</div>
    <div class="stat-sub">{{ $stats['total_categories'] }} kategori</div>
  </div>
  <div class="stat-card accent-blue">
    <div class="stat-icon-row"><div class="stat-icon blue"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><polyline points="23 4 23 10 17 10"/><polyline points="1 20 1 14 7 14"/><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/></svg></div></div>
    <div class="stat-label">Dipinjam Aktif</div>
    <div class="stat-num blue">{{ number_format($stats['active_borrowings']) }}</div>
    <div class="stat-sub">{{ $stats['pending_borrow'] }} menunggu konfirmasi</div>
  </div>
  <div class="stat-card accent-amber">
    <div class="stat-icon-row"><div class="stat-icon amber"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div></div>
    <div class="stat-label">Terlambat</div>
    <div class="stat-num amber">{{ $overdue }}</div>
    <div class="stat-sub">Perlu ditindaklanjuti</div>
  </div>
</div>
<div class="two-col">
  <div class="card">
    <div class="card-head">Peminjaman Terkini<a href="{{ route('admin.borrowings.index') }}" class="see-all">Semua →</a></div>
    <div class="card-body">
      @forelse($recentBorrowings as $b)
      <div class="recent-row">
        <div class="recent-av">{{ strtoupper(substr($b->user->name ?? 'XX',0,2)) }}</div>
        <div style="min-width:0"><div class="recent-name">{{ $b->user->name ?? '-' }}</div><div class="recent-sub" style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ Str::limit($b->book->title ?? '-',28) }}</div></div>
        <div class="recent-date">
          @if($b->status==='pending')<span class="badge badge-blue">Pending</span>
          @elseif($b->status==='approved')<span class="badge badge-green">Aktif</span>
          @elseif($b->status==='returning')<span class="badge badge-amber">Kembali</span>
          @else<span class="badge badge-muted">Selesai</span>@endif
        </div>
      </div>
      @empty<div style="text-align:center;padding:20px;color:var(--muted-2);font-size:.8rem">Kosong</div>@endforelse
    </div>
  </div>
  <div class="card">
    <div class="card-head">Buku Terpopuler</div>
    <div class="card-body">
      @foreach($popularBooks as $i => $book)
      <div class="top-book-item">
        <div class="tb-rank {{ $i<3?'top':'' }}">{{ $i+1 }}</div>
        <div style="flex:1;min-width:0"><div class="tb-title">{{ Str::limit($book->title,30) }}</div><div class="tb-author">{{ $book->author }}</div></div>
        <div class="tb-count">{{ $book->borrow_count ?? 0 }}×</div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endif

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
<script>
@if($isAdmin)
Chart.defaults.font.family = "'DM Sans', system-ui, sans-serif";
Chart.defaults.color = '#a09a90';

// ── BAR CHART ──
(function(){
  const ctx = document.getElementById('barChart');
  if(!ctx) return;
  new Chart(ctx.getContext('2d'), {
    type: 'bar',
    data: {
      labels: @json($weeklyLabels),
      datasets: [
        { label:'Dipinjam',    data:@json($weeklyBorrowed), backgroundColor:'rgba(28,107,70,0.85)',  borderRadius:5, borderSkipped:false, barPercentage:.55, categoryPercentage:.72 },
        { label:'Dikembalikan',data:@json($weeklyReturned), backgroundColor:'rgba(201,197,186,0.65)',borderRadius:5, borderSkipped:false, barPercentage:.55, categoryPercentage:.72 }
      ]
    },
    options:{
      responsive:true, maintainAspectRatio:true,
      interaction:{mode:'index',intersect:false},
      plugins:{
        legend:{display:false},
        tooltip:{backgroundColor:'#16140f',titleColor:'#f9f8f5',bodyColor:'#a09a90',padding:10,cornerRadius:8,
          callbacks:{label:c=>` ${c.dataset.label}: ${c.parsed.y} buku`}
        }
      },
      scales:{
        x:{grid:{display:false},border:{display:false},ticks:{font:{size:10,family:"'Syne',sans-serif"},maxRotation:0}},
        y:{grid:{color:'rgba(228,226,218,0.6)'},border:{display:false,dash:[4,4]},ticks:{font:{size:10},stepSize:5},beginAtZero:true}
      }
    }
  });
})();

// ── DONUT CHART ──
(function(){
  const ctx = document.getElementById('donutChart');
  if(!ctx) return;
  const labels = @json(array_column($donutData,'name'));
  const data   = @json(array_column($donutData,'pct'));
  const colors = ['#1c6b46','#1a5280','#b8760a','#7b3fa0','#c0392b'];
  const total  = {{ $stats['total_books'] }};
  new Chart(ctx.getContext('2d'), {
    type:'doughnut',
    data:{ labels, datasets:[{ data, backgroundColor:colors.slice(0,data.length), borderWidth:3, borderColor:'#ffffff', hoverOffset:6 }] },
    options:{
      responsive:false, cutout:'68%',
      plugins:{
        legend:{display:false},
        tooltip:{backgroundColor:'#16140f',titleColor:'#f9f8f5',bodyColor:'#a09a90',padding:10,cornerRadius:8,
          callbacks:{label:c=>` ${c.label}: ${c.parsed}%`}
        }
      }
    },
    plugins:[{
      id:'centerText',
      beforeDraw(chart){
        const{width,height,ctx}=chart; ctx.save();
        ctx.font="bold 20px 'Instrument Serif',serif";
        ctx.fillStyle='#16140f'; ctx.textAlign='center'; ctx.textBaseline='middle';
        ctx.fillText(total.toLocaleString('id'), width/2, height/2-8);
        ctx.font="10px 'Syne',sans-serif"; ctx.fillStyle='#a09a90';
        ctx.fillText('Total Buku', width/2, height/2+14); ctx.restore();
      }
    }]
  });
})();

// ── SPARKLINES ──
function makeSparkline(id, data, color) {
  const canvas = document.getElementById(id);
  if(!canvas) return;
  canvas.width  = canvas.parentElement.offsetWidth || 200;
  canvas.height = 36;
  const ctx  = canvas.getContext('2d');
  const grad = ctx.createLinearGradient(0,0,0,36);
  grad.addColorStop(0, color.replace('rgb(','rgba(').replace(')',',0.18)'));
  grad.addColorStop(1, color.replace('rgb(','rgba(').replace(')',',0)'));
  new Chart(ctx,{
    type:'line',
    data:{labels:data.map((_,i)=>i),datasets:[{data,borderColor:color,borderWidth:1.8,pointRadius:0,fill:true,backgroundColor:grad,tension:.45}]},
    options:{
      responsive:false,
      plugins:{legend:{display:false},tooltip:{enabled:false}},
      scales:{x:{display:false},y:{display:false,beginAtZero:false}},
      animation:{duration:800,easing:'easeInOutQuart'}
    }
  });
}

makeSparkline('sparkline1', [{{ implode(',', array_slice(array_values($weeklyBorrowed??[1,1,1,1,1,1,1,1,1,1]),0,10)) }}], 'rgb(28,107,70)');
makeSparkline('sparkline2', [{{ implode(',', array_slice(array_values($weeklyBorrowed??[1,1,1,1,1,1,1,1,1,1]),0,10)) }}], 'rgb(26,82,128)');
makeSparkline('sparkline3', [1,0,1,0,0,1,{{ $overdue }},{{ $overdue }},{{ $overdue }},{{ $overdue }}], 'rgb(192,57,43)');
makeSparkline('sparkline4', [1,1,2,3,3,4,{{ max(1,$stats['total_users']) }},{{ max(1,$stats['total_users']) }},{{ max(1,$stats['total_users']) }},{{ max(1,$stats['total_users']) }}], 'rgb(184,118,10)');
@endif
</script>
@endpush
