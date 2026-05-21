@extends('layouts.admin')
@section('title','Laporan Petugas')
@section('page-title','Laporan Petugas')
@section('page-subtitle','Data petugas dan administrator perpustakaan')

@push('styles')
<style>
.rpt-toolbar{display:flex;align-items:center;gap:10px;margin-bottom:18px;flex-wrap:wrap}
.rpt-stat{background:var(--white);border:1px solid var(--border);border-radius:10px;padding:14px 20px;display:inline-flex;flex-direction:column;gap:3px;min-width:130px}
.rpt-stat-val{font-family:'Instrument Serif',serif;font-size:1.6rem;color:var(--ink);letter-spacing:-.03em}
.rpt-stat-lbl{font-family:'Syne',sans-serif;font-size:.6rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--muted)}
</style>
@endpush

@section('content')
{{-- Export Bar --}}
<div class="rpt-toolbar">
  <div style="flex:1"></div>
  <a href="{{ route('admin.reports.staff', ['format'=>'csv']) }}" class="btn-secondary">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
    Export CSV
  </a>
  <a href="{{ route('admin.reports.staff', ['format'=>'pdf']) }}" class="btn-danger">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
    Export PDF
  </a>
  <a href="{{ route('admin.reports.index') }}" class="btn-secondary">← Kembali</a>
</div>

{{-- Summary Stats --}}
<div style="display:flex;gap:12px;margin-bottom:20px;flex-wrap:wrap">
  <div class="rpt-stat">
    <span class="rpt-stat-val">{{ $staff->count() }}</span>
    <span class="rpt-stat-lbl">Total Staf</span>
  </div>
  <div class="rpt-stat">
    <span class="rpt-stat-val">{{ $staff->where('role','admin')->count() }}</span>
    <span class="rpt-stat-lbl">Admin</span>
  </div>
  <div class="rpt-stat">
    <span class="rpt-stat-val">{{ $staff->where('role','petugas')->count() }}</span>
    <span class="rpt-stat-lbl">Petugas</span>
  </div>
  <div class="rpt-stat">
    <span class="rpt-stat-val">{{ $staff->sum('proposals_count') }}</span>
    <span class="rpt-stat-lbl">Total Usulan Buku</span>
  </div>
</div>

<div class="table-wrap">
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Username</th>
        <th>Email</th>
        <th>No HP</th>
        <th>Kota</th>
        <th>Role</th>
        <th>Usulan Buku</th>
        <th>Diterima</th>
        <th>Bergabung</th>
      </tr>
    </thead>
    <tbody>
      @forelse($staff as $i => $s)
      <tr>
        <td style="color:var(--muted-2);font-size:.72rem">{{ $i + 1 }}</td>
        <td>
          <div style="font-weight:600;font-size:.82rem">{{ $s->name }}</div>
          <div style="font-size:.68rem;color:var(--muted-2)">{{ $s->city ?? '-' }}</div>
        </td>
        <td style="font-size:.78rem;color:var(--muted)">{{ $s->username }}</td>
        <td style="font-size:.78rem">{{ $s->email }}</td>
        <td style="font-size:.78rem;color:var(--muted)">{{ $s->phone ?? '-' }}</td>
        <td style="font-size:.78rem;color:var(--muted)">{{ $s->city ?? '-' }}</td>
        <td>
          @if($s->role === 'admin')
            <span class="badge badge-green">Admin</span>
          @else
            <span class="badge badge-blue">Petugas</span>
          @endif
        </td>
        <td style="font-size:.82rem;text-align:center">{{ $s->proposals_count }}</td>
        <td style="font-size:.82rem;text-align:center;color:var(--green)">{{ $s->proposals_approved }}</td>
        <td style="font-size:.75rem;color:var(--muted)">{{ $s->created_at->format('d/m/Y') }}</td>
      </tr>
      @empty
      <tr><td colspan="10" style="text-align:center;padding:48px 0;color:var(--muted-2);font-size:.82rem">Tidak ada data petugas.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
