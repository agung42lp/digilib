@extends('layouts.admin')
@section('title','Usulan Buku')
@section('page-title','Usulan Buku')
@section('page-subtitle', ($stats['total'] ?? 0) . ' total usulan · ' . ($stats['pending'] ?? 0) . ' menunggu persetujuan')

@section('header-actions')
<a href="{{ route('admin.books.proposals.create') }}" class="btn-primary">
  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
  Usulkan Buku Baru
</a>
@endsection

@section('content')

<div class="stats-grid">
  <div class="stat-card"><div class="stat-label">Total Usulan</div><div class="stat-num">{{ $stats['total'] ?? 0 }}</div><div class="stat-sub">Sepanjang waktu</div></div>
  <div class="stat-card"><div class="stat-label">Menunggu</div><div class="stat-num amber">{{ $stats['pending'] ?? 0 }}</div><div class="stat-sub">Direview admin</div></div>
  <div class="stat-card"><div class="stat-label">Disetujui</div><div class="stat-num green">{{ $stats['approved'] ?? 0 }}</div><div class="stat-sub">Masuk koleksi</div></div>
  <div class="stat-card"><div class="stat-label">Ditolak</div><div class="stat-num red">{{ $stats['rejected'] ?? 0 }}</div><div class="stat-sub">Tidak memenuhi syarat</div></div>
</div>

<div class="table-wrap">
  <form class="table-toolbar" method="GET" action="{{ route('admin.books.proposals.index') }}">
    <div class="tb-search">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" style="color:var(--muted-2);flex-shrink:0"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <input name="search" placeholder="Cari judul atau penulis..." value="{{ request('search') }}">
    </div>
    <select class="tb-select" name="status" onchange="this.form.submit()">
      <option value="">Semua Status</option>
      <option value="pending" {{ request('status')==='pending'?'selected':'' }}>Menunggu</option>
      <option value="approved" {{ request('status')==='approved'?'selected':'' }}>Disetujui</option>
      <option value="rejected" {{ request('status')==='rejected'?'selected':'' }}>Ditolak</option>
    </select>
    <div class="tb-spacer"></div>
  </form>
  <table>
    <thead>
      <tr><th>#</th><th>Judul Buku</th><th>Penulis</th><th>Kategori</th><th>Tgl Usulan</th><th>Status</th><th>Catatan Admin</th><th style="text-align:right">Aksi</th></tr>
    </thead>
    <tbody>
      @forelse($proposals as $p)
      <tr style="{{ in_array($p->status,['approved','rejected'])?'opacity:.8':'' }}">
        <td style="color:var(--muted-2);font-size:.72rem">USL-{{ str_pad($p->id,3,'0',STR_PAD_LEFT) }}</td>
        <td>
          <div style="font-weight:500">{{ Str::limit($p->title,35) }}</div>
          @if($p->isbn)<div style="font-size:.68rem;color:var(--muted-2)">ISBN: {{ $p->isbn }}</div>@endif
        </td>
        <td>{{ $p->author }}</td>
        <td><span class="badge badge-muted">{{ $p->category->name ?? '—' }}</span></td>
        <td style="font-size:.72rem;color:var(--muted-2)">{{ $p->created_at->format('d M Y') }}</td>
        <td>
          <span class="badge {{ $p->status==='pending'?'badge-amber':($p->status==='approved'?'badge-green':'badge-red') }}">
            {{ $p->status==='pending'?'Menunggu':($p->status==='approved'?'Disetujui':'Ditolak') }}
          </span>
        </td>
        <td style="font-size:.76rem;color:{{ $p->status==='rejected'?'var(--red)':'var(--muted-2)' }}">
          {{ $p->admin_note ?? '—' }}
        </td>
        <td>
          <div class="row-actions">
            <button type="button" class="action-btn" title="Lihat Detail" onclick="openDetailModal('{{ addslashes($p->title) }}','{{ addslashes($p->author) }}','{{ $p->category->name ?? '' }}','{{ $p->isbn ?? '' }}','{{ $p->created_at->format('d M Y') }}','{{ $p->status }}','{{ addslashes($p->reason ?? '') }}','{{ addslashes($p->admin_note ?? '') }}')">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
            </button>
            @if($p->status==='pending')
            <form method="POST" action="{{ route('admin.books.proposals.destroy',$p) }}">
              @csrf @method('DELETE')
              <button type="submit" class="action-btn danger" title="Tarik Usulan" onclick="return confirm('Tarik usulan ini?')">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
              </button>
            </form>
            @endif
          </div>
        </td>
      </tr>
      @empty
      <tr><td colspan="8" style="text-align:center;padding:48px;color:var(--muted-2);font-size:.82rem">Belum ada usulan.</td></tr>
      @endforelse
    </tbody>
  </table>
  <div class="pagination">
    <span class="pag-info">Menampilkan {{ $proposals->firstItem() }}–{{ $proposals->lastItem() }} dari {{ $proposals->total() }} data</span>
    <div class="pag-btns">
      @if($proposals->onFirstPage())<span class="pag-btn disabled">‹</span>@else<a href="{{ $proposals->appends(request()->except('page'))->previousPageUrl() }}" class="pag-btn">‹</a>@endif
      @foreach($proposals->appends(request()->except('page'))->getUrlRange(max(1,$proposals->currentPage()-2),min($proposals->lastPage(),$proposals->currentPage()+2)) as $page => $url)
        <a href="{{ $url }}" class="pag-btn {{ $page==$proposals->currentPage()?'active':'' }}">{{ $page }}</a>
      @endforeach
      @if($proposals->hasMorePages())<a href="{{ $proposals->appends(request()->except('page'))->nextPageUrl() }}" class="pag-btn">›</a>@else<span class="pag-btn disabled">›</span>@endif
    </div>
  </div>
</div>

{{-- Modal Detail --}}
<div id="modal-detail" class="modal-overlay" onclick="handleOverlayClick(event,'detail')">
  <div class="modal wide">
    <div class="modal-header">
      <div>
        <div class="modal-title" id="det-title">—</div>
        <div style="font-size:.72rem;color:var(--muted);margin-top:2px" id="det-meta">—</div>
      </div>
      <div style="display:flex;align-items:center;gap:8px">
        <span class="badge" id="det-badge">—</span>
        <button type="button" class="modal-close" onclick="closeModal('detail')"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
      </div>
    </div>
    <div class="modal-body">
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px">
        <div><div class="m-field-label" style="margin-bottom:4px">Kategori</div><div style="font-size:.82rem" id="det-cat">—</div></div>
        <div><div class="m-field-label" style="margin-bottom:4px">ISBN</div><div style="font-size:.82rem" id="det-isbn">—</div></div>
        <div><div class="m-field-label" style="margin-bottom:4px">Tanggal Usulan</div><div style="font-size:.82rem" id="det-date">—</div></div>
      </div>
      <div>
        <div class="m-field-label" style="margin-bottom:4px">Alasan Pengajuan</div>
        <div style="font-size:.82rem;color:var(--muted);background:var(--surface);padding:10px 12px;border-radius:8px;line-height:1.6" id="det-reason">—</div>
      </div>
      <div id="det-note-wrap" style="display:none">
        <div class="m-field-label" style="margin-bottom:4px">Catatan Admin</div>
        <div style="font-size:.82rem;color:var(--red);background:var(--red-pale);padding:10px 12px;border-radius:8px;line-height:1.6" id="det-note">—</div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="modal-btn-cancel" onclick="closeModal('detail')">Tutup</button>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
const statusLabels={'pending':'Menunggu','approved':'Disetujui','rejected':'Ditolak'};
const statusClass={'pending':'badge-amber','approved':'badge-green','rejected':'badge-red'};
function openDetailModal(title,author,cat,isbn,date,status,reason,note){
  document.getElementById('det-title').textContent=title;
  document.getElementById('det-meta').textContent=author;
  document.getElementById('det-cat').textContent=cat||'—';
  document.getElementById('det-isbn').textContent=isbn||'—';
  document.getElementById('det-date').textContent=date;
  document.getElementById('det-reason').textContent=reason||'—';
  const badge=document.getElementById('det-badge');
  badge.textContent=statusLabels[status]||status;
  badge.className='badge '+(statusClass[status]||'badge-muted');
  const noteWrap=document.getElementById('det-note-wrap');
  if(note&&note!==''){
    document.getElementById('det-note').textContent=note;
    noteWrap.style.display='block';
  }else{noteWrap.style.display='none'}
  openModal('detail');
}
</script>
@endpush
