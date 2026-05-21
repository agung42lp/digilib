@extends('layouts.admin')
@section('title','Laporan Buku')
@section('page-title','Laporan Buku')
@section('page-subtitle','Data seluruh koleksi buku perpustakaan')

@push('styles')
<style>
.rpt-toolbar{display:flex;align-items:center;gap:10px;margin-bottom:18px;flex-wrap:wrap}
.rpt-stat{background:var(--white);border:1px solid var(--border);border-radius:10px;padding:14px 20px;display:inline-flex;flex-direction:column;gap:3px;min-width:130px}
.rpt-stat-val{font-family:'Instrument Serif',serif;font-size:1.6rem;color:var(--ink);letter-spacing:-.03em}
.rpt-stat-lbl{font-family:'Syne',sans-serif;font-size:.6rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--muted)}
</style>
@endpush

@section('content')
{{-- Filter & Export Bar --}}
<form method="GET" action="{{ route('admin.reports.books') }}" class="rpt-toolbar">
  <select name="category_id" class="tb-select" onchange="this.form.submit()">
    <option value="">Semua Kategori</option>
    @foreach($categories as $cat)
      <option value="{{ $cat->id }}" {{ request('category_id')==$cat->id?'selected':'' }}>{{ $cat->name }}</option>
    @endforeach
  </select>
  @if(request('category_id'))
    <a href="{{ route('admin.reports.books') }}" class="btn-secondary">Reset</a>
  @endif
  <div style="flex:1"></div>
  <a href="{{ route('admin.reports.books', array_merge(request()->query(), ['format'=>'csv'])) }}" class="btn-secondary">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
    Export CSV
  </a>
  <a href="{{ route('admin.reports.books', array_merge(request()->query(), ['format'=>'pdf'])) }}" class="btn-danger">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
    Export PDF
  </a>
  <a href="{{ route('admin.reports.index') }}" class="btn-secondary">← Kembali</a>
</form>

{{-- Summary Stats --}}
<div style="display:flex;gap:12px;margin-bottom:20px;flex-wrap:wrap">
  <div class="rpt-stat">
    <span class="rpt-stat-val">{{ $books->count() }}</span>
    <span class="rpt-stat-lbl">Total Buku</span>
  </div>
  <div class="rpt-stat">
    <span class="rpt-stat-val">{{ $books->sum('stock') }}</span>
    <span class="rpt-stat-lbl">Total Stok</span>
  </div>
  <div class="rpt-stat">
    <span class="rpt-stat-val">{{ $books->sum('borrowed_count') }}</span>
    <span class="rpt-stat-lbl">Total Dipinjam</span>
  </div>
  <div class="rpt-stat">
    <span class="rpt-stat-val">{{ $books->where('stock',0)->count() }}</span>
    <span class="rpt-stat-lbl">Stok Habis</span>
  </div>
</div>

<div class="table-wrap">
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Judul Buku</th>
        <th>Penulis</th>
        <th>Kategori</th>
        <th>ISBN</th>
        <th>Stok</th>
        <th>Dipinjam</th>
        <th>Rating</th>
      </tr>
    </thead>
    <tbody>
      @forelse($books as $i => $book)
      <tr>
        <td style="color:var(--muted-2);font-size:.72rem">{{ $i+1 }}</td>
        <td>
          <div style="font-weight:600;font-size:.82rem">{{ $book->title }}</div>
          <div style="font-size:.68rem;color:var(--muted)">{{ $book->publisher }}</div>
        </td>
        <td style="font-size:.78rem;color:var(--muted)">{{ $book->author }}</td>
        <td><span class="badge badge-muted">{{ $book->category->name ?? '-' }}</span></td>
        <td style="font-size:.72rem;color:var(--muted-2)">{{ $book->isbn ?? '—' }}</td>
        <td><span class="badge {{ $book->stock > 0 ? 'badge-green' : 'badge-red' }}">{{ $book->stock }}</span></td>
        <td style="font-size:.8rem;color:var(--muted)">{{ $book->borrowed_count }}×</td>
        <td>
          @php $r = $book->avgRating() @endphp
          <span style="color:var(--amber);font-size:.8rem">{{ str_repeat('★', (int)$r) }}{{ str_repeat('☆', 5-(int)$r) }}</span>
          <span style="font-size:.65rem;color:var(--muted-2)">({{ $r }})</span>
        </td>
      </tr>
      @empty
      <tr><td colspan="8" style="text-align:center;padding:40px;color:var(--muted-2)">Tidak ada data.</td></tr>
      @endforelse
    </tbody>
  </table>
  <div class="pagination">
    <span class="pag-info">{{ $books->count() }} buku ditemukan</span>
    <span style="font-size:.68rem;color:var(--muted-2)">Dihasilkan: {{ now()->format('d M Y, H:i') }}</span>
  </div>
</div>
@endsection
