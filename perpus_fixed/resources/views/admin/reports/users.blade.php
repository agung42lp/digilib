@extends('layouts.admin')
@section('title','Laporan User')
@section('page-title','Laporan User')
@section('page-subtitle','Data seluruh anggota perpustakaan')

@push('styles')
<style>
.rpt-toolbar{display:flex;align-items:center;gap:10px;margin-bottom:18px;flex-wrap:wrap}
.rpt-stat{background:var(--white);border:1px solid var(--border);border-radius:10px;padding:14px 20px;display:inline-flex;flex-direction:column;gap:3px;min-width:130px}
.rpt-stat-val{font-family:'Instrument Serif',serif;font-size:1.6rem;color:var(--ink);letter-spacing:-.03em}
.rpt-stat-lbl{font-family:'Syne',sans-serif;font-size:.6rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--muted)}
</style>
@endpush

@section('content')
<div class="rpt-toolbar">
  <div style="flex:1"></div>
  <a href="{{ route('admin.reports.users', ['format'=>'csv']) }}" class="btn-secondary">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
    Export CSV
  </a>
  <a href="{{ route('admin.reports.users', ['format'=>'pdf']) }}" class="btn-danger">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
    Export PDF
  </a>
  <a href="{{ route('admin.reports.index') }}" class="btn-secondary">← Kembali</a>
</div>

<div style="display:flex;gap:12px;margin-bottom:20px;flex-wrap:wrap">
  <div class="rpt-stat">
    <span class="rpt-stat-val">{{ $users->count() }}</span>
    <span class="rpt-stat-lbl">Total Anggota</span>
  </div>
  <div class="rpt-stat">
    <span class="rpt-stat-val">{{ $users->where('is_active', true)->count() }}</span>
    <span class="rpt-stat-lbl">Aktif</span>
  </div>
  <div class="rpt-stat">
    <span class="rpt-stat-val">{{ $users->where('is_active', false)->count() }}</span>
    <span class="rpt-stat-lbl">Nonaktif</span>
  </div>
  <div class="rpt-stat">
    <span class="rpt-stat-val">{{ $users->sum('borrowings_count') }}</span>
    <span class="rpt-stat-lbl">Total Pinjaman</span>
  </div>
</div>

<div class="table-wrap">
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Nama</th>
        <th>Username</th>
        <th>Email</th>
        <th>No HP</th>
        <th>Kota</th>
        <th>Status</th>
        <th>Total Pinjam</th>
        <th>Bergabung</th>
      </tr>
    </thead>
    <tbody>
      @forelse($users as $i => $u)
      <tr>
        <td style="color:var(--muted-2);font-size:.72rem">{{ $i+1 }}</td>
        <td style="font-weight:600;font-size:.82rem">{{ $u->name }}</td>
        <td><code style="font-size:.72rem;background:var(--surface);padding:2px 7px;border-radius:5px;color:var(--muted)">{{ $u->username }}</code></td>
        <td style="font-size:.75rem;color:var(--muted)">{{ $u->email }}</td>
        <td style="font-size:.75rem;color:var(--muted)">{{ $u->phone ?? '—' }}</td>
        <td style="font-size:.75rem;color:var(--muted)">{{ $u->city ?? '—' }}</td>
        <td><span class="badge {{ $u->is_active ? 'badge-green' : 'badge-muted' }}">{{ $u->is_active ? 'Aktif' : 'Nonaktif' }}</span></td>
        <td style="font-size:.8rem;text-align:center">{{ $u->borrowings_count }}</td>
        <td style="font-size:.72rem;color:var(--muted-2)">{{ $u->created_at->format('d/m/Y') }}</td>
      </tr>
      @empty
      <tr><td colspan="9" style="text-align:center;padding:40px;color:var(--muted-2)">Tidak ada data.</td></tr>
      @endforelse
    </tbody>
  </table>
  <div class="pagination">
    <span class="pag-info">{{ $users->count() }} anggota ditemukan</span>
    <span style="font-size:.68rem;color:var(--muted-2)">Dihasilkan: {{ now()->format('d M Y, H:i') }}</span>
  </div>
</div>
@endsection
