@extends('layouts.admin')
@section('title','Laporan Peminjaman')
@section('page-title','Laporan Peminjaman')
@section('page-subtitle','Rekap data peminjaman dan pengembalian buku')

@push('styles')
<style>
.rpt-toolbar{display:flex;align-items:center;gap:10px;margin-bottom:18px;flex-wrap:wrap}
.rpt-stat{background:var(--white);border:1px solid var(--border);border-radius:10px;padding:14px 20px;display:inline-flex;flex-direction:column;gap:3px;min-width:130px}
.rpt-stat-val{font-family:'Instrument Serif',serif;font-size:1.6rem;color:var(--ink);letter-spacing:-.03em}
.rpt-stat-lbl{font-family:'Syne',sans-serif;font-size:.6rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--muted)}
</style>
@endpush

@section('content')
<form method="GET" action="{{ route('admin.reports.borrowings') }}" class="rpt-toolbar">
  <select name="status" class="tb-select" onchange="this.form.submit()">
    <option value="">Semua Status</option>
    <option value="pending"   {{ request('status')=='pending'  ?'selected':'' }}>Menunggu</option>
    <option value="approved"  {{ request('status')=='approved' ?'selected':'' }}>Dipinjam</option>
    <option value="returning" {{ request('status')=='returning'?'selected':'' }}>Pengajuan Kembali</option>
    <option value="returned"  {{ request('status')=='returned' ?'selected':'' }}>Sudah Kembali</option>
    <option value="rejected"  {{ request('status')=='rejected' ?'selected':'' }}>Ditolak</option>
  </select>
  <input type="date" name="from" class="form-control" style="width:auto;height:36px;font-size:.78rem;border:1.5px solid var(--border);border-radius:9px;padding:0 12px"
         value="{{ request('from') }}" placeholder="Dari tanggal">
  <input type="date" name="to" class="form-control" style="width:auto;height:36px;font-size:.78rem;border:1.5px solid var(--border);border-radius:9px;padding:0 12px"
         value="{{ request('to') }}" placeholder="Sampai tanggal">
  <button type="submit" class="btn-secondary">Filter</button>
  @if(request()->anyFilled(['status','from','to']))
    <a href="{{ route('admin.reports.borrowings') }}" class="btn-secondary">Reset</a>
  @endif
  <div style="flex:1"></div>
  <a href="{{ route('admin.reports.borrowings', array_merge(request()->query(), ['format'=>'csv'])) }}" class="btn-secondary">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
    Export CSV
  </a>
  <a href="{{ route('admin.reports.borrowings', array_merge(request()->query(), ['format'=>'pdf'])) }}" class="btn-danger">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
    Export PDF
  </a>
  <a href="{{ route('admin.reports.index') }}" class="btn-secondary">← Kembali</a>
</form>

@php
  $totalFine = $borrowings->sum('fine_amount');
  $lateCount = $borrowings->filter(fn($b) => $b->fine_amount > 0)->count();
@endphp

<div style="display:flex;gap:12px;margin-bottom:20px;flex-wrap:wrap">
  <div class="rpt-stat">
    <span class="rpt-stat-val">{{ $borrowings->count() }}</span>
    <span class="rpt-stat-lbl">Total Transaksi</span>
  </div>
  <div class="rpt-stat">
    <span class="rpt-stat-val">{{ $borrowings->where('status','returned')->count() }}</span>
    <span class="rpt-stat-lbl">Sudah Kembali</span>
  </div>
  <div class="rpt-stat">
    <span class="rpt-stat-val">{{ $lateCount }}</span>
    <span class="rpt-stat-lbl">Terlambat</span>
  </div>
  <div class="rpt-stat">
    <span class="rpt-stat-val" style="font-size:1.1rem">Rp {{ number_format($totalFine, 0, ',', '.') }}</span>
    <span class="rpt-stat-lbl">Total Denda</span>
  </div>
</div>

<div class="table-wrap">
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Peminjam</th>
        <th>Buku</th>
        <th>Tgl Pinjam</th>
        <th>Tgl Kembali</th>
        <th>Tgl Aktual</th>
        <th>Status</th>
        <th>Denda</th>
      </tr>
    </thead>
    <tbody>
      @forelse($borrowings as $i => $b)
      <tr>
        <td style="color:var(--muted-2);font-size:.72rem">{{ $i+1 }}</td>
        <td>
          <div style="font-weight:600;font-size:.82rem">{{ $b->user->name }}</div>
          <div style="font-size:.68rem;color:var(--muted)">{{ $b->user->email }}</div>
        </td>
        <td style="font-size:.78rem">{{ Str::limit($b->book->title, 32) }}</td>
        <td style="font-size:.75rem;color:var(--muted)">{{ $b->borrow_date->format('d/m/Y') }}</td>
        <td style="font-size:.75rem;color:var(--muted)">{{ $b->return_date->format('d/m/Y') }}</td>
        <td style="font-size:.75rem;color:var(--muted)">{{ $b->actual_return_date ? $b->actual_return_date->format('d/m/Y') : '—' }}</td>
        <td>
          @php $sm=['pending'=>'badge-amber','approved'=>'badge-blue','returning'=>'badge-amber','returned'=>'badge-muted','rejected'=>'badge-red'] @endphp
          <span class="badge {{ $sm[$b->status] ?? 'badge-muted' }}">{{ $b->status_label }}</span>
        </td>
        <td>
          @if($b->fine_amount > 0)
            <span class="badge badge-red">Rp {{ number_format($b->fine_amount, 0, ',', '.') }}</span>
          @else
            <span style="color:var(--muted-2);font-size:.72rem">—</span>
          @endif
        </td>
      </tr>
      @empty
      <tr><td colspan="8" style="text-align:center;padding:40px;color:var(--muted-2)">Tidak ada data.</td></tr>
      @endforelse
    </tbody>
  </table>
  <div class="pagination">
    <span class="pag-info">{{ $borrowings->count() }} transaksi ditemukan</span>
    <span style="font-size:.68rem;color:var(--muted-2)">Dihasilkan: {{ now()->format('d M Y, H:i') }}</span>
  </div>
</div>
@endsection
