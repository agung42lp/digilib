@extends('layouts.admin')
@section('title','Manajemen Buku')
@section('page-title','Kelola Buku')
@section('page-subtitle', ($books->total() ?? 0) . ' judul terdaftar')

@php
  use App\Models\{Category, BookProposal};
  $activeTab = request('tab','books');
  $pendingProposals = BookProposal::pending()->count();
  $totalProposals   = BookProposal::count();
@endphp

@section('content')

@if($errors->any())
<div class="flash-error">
  @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
</div>
@endif

{{-- ══ TAB NAV ══ --}}
<div class="page-tabs">
  <a class="ptab {{ $activeTab==='books'?'active':'' }}" href="{{ route('admin.books.index',['tab'=>'books']) }}">
    Daftar Buku <span class="ptab-cnt">{{ $books->total() ?? 0 }}</span>
  </a>
  <a class="ptab {{ $activeTab==='categories'?'active':'' }}" href="{{ route('admin.books.index',['tab'=>'categories']) }}">
    Kelola Kategori <span class="ptab-cnt">{{ $categories->count() }}</span>
  </a>
  <a class="ptab {{ $activeTab==='proposals'?'active':'' }}" href="{{ route('admin.books.index',['tab'=>'proposals']) }}">
    Persetujuan Buku <span class="ptab-cnt {{ $pendingProposals>0?'warn':'' }}">{{ $pendingProposals ?: $totalProposals }}</span>
  </a>
</div>

{{-- ══ TAB: DAFTAR BUKU ══ --}}
@if($activeTab==='books')
<div class="table-wrap">
  <form class="table-toolbar" method="GET" action="{{ route('admin.books.index') }}">
    <input type="hidden" name="tab" value="books">
    <div class="tb-search">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" style="color:var(--muted-2);flex-shrink:0"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <input name="search" placeholder="Cari judul, penulis, ISBN..." value="{{ request('search') }}">
    </div>
    <select class="tb-select" name="category_id" onchange="this.form.submit()">
      <option value="">Semua Kategori</option>
      @foreach(Category::orderBy('name')->get() as $cat)
        <option value="{{ $cat->id }}" {{ request('category_id')==$cat->id?'selected':'' }}>{{ $cat->name }}</option>
      @endforeach
    </select>
    <select class="tb-select" name="status" onchange="this.form.submit()">
      <option value="">Semua Status</option>
      <option value="available" {{ request('status')==='available'?'selected':'' }}>Tersedia</option>
      <option value="empty" {{ request('status')==='empty'?'selected':'' }}>Habis</option>
    </select>
    <div class="tb-spacer"></div>
    <a href="{{ route('admin.books.create') }}" class="btn-primary">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
      Tambah Buku
    </a>
  </form>
  <table>
    <thead>
      <tr><th>#</th><th>Judul Buku</th><th>Penulis</th><th>Kategori</th><th>Stok</th><th>Status</th><th>Ditambahkan</th><th style="text-align:right">Aksi</th></tr>
    </thead>
    <tbody>
      @forelse($books as $b)
      <tr>
        <td style="color:var(--muted-2);font-size:.72rem">BK-{{ str_pad($b->id,3,'0',STR_PAD_LEFT) }}</td>
        <td>
          <div style="font-weight:500">{{ Str::limit($b->title,35) }}</div>
          @if($b->isbn)<div style="font-size:.68rem;color:var(--muted-2)">ISBN: {{ $b->isbn }}</div>@endif
        </td>
        <td>{{ $b->author }}</td>
        <td><span class="badge badge-muted">{{ $b->category->name ?? '—' }}</span></td>
        <td style="font-weight:600{{ $b->stock==0?';color:var(--red)':'' }}">{{ $b->stock }}</td>
        <td>
          @if($b->stock > 0)
            <span class="badge badge-green">Tersedia</span>
          @else
            <span class="badge badge-red">Habis</span>
          @endif
        </td>
        <td style="font-size:.72rem;color:var(--muted-2)">{{ $b->created_at->format('d M Y') }}</td>
        <td>
          <div class="row-actions">
            <a href="{{ route('admin.books.show',$b) }}" class="action-btn" title="Detail">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
            </a>
            <a href="{{ route('admin.books.edit',$b) }}" class="action-btn" title="Edit">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            </a>
            <button type="button" class="action-btn danger" title="Hapus" onclick="openDeleteModal({{ $b->id }},'{{ addslashes($b->title) }}')">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
            </button>
          </div>
        </td>
      </tr>
      @empty
      <tr><td colspan="8" style="text-align:center;padding:48px;color:var(--muted-2);font-size:.82rem">Tidak ada buku ditemukan.</td></tr>
      @endforelse
    </tbody>
  </table>
  <div class="pagination">
    <span class="pag-info">Menampilkan {{ $books->firstItem() }}–{{ $books->lastItem() }} dari {{ $books->total() }} buku</span>
    <div class="pag-btns">
      @if($books->onFirstPage())
        <span class="pag-btn disabled">‹</span>
      @else
        <a href="{{ $books->appends(request()->except('page'))->previousPageUrl() }}" class="pag-btn">‹</a>
      @endif
      @foreach($books->appends(request()->except('page'))->getUrlRange(max(1,$books->currentPage()-2), min($books->lastPage(),$books->currentPage()+2)) as $page => $url)
        <a href="{{ $url }}" class="pag-btn {{ $page==$books->currentPage()?'active':'' }}">{{ $page }}</a>
      @endforeach
      @if($books->hasMorePages())
        <a href="{{ $books->appends(request()->except('page'))->nextPageUrl() }}" class="pag-btn">›</a>
      @else
        <span class="pag-btn disabled">›</span>
      @endif
    </div>
  </div>
</div>
@endif

{{-- ══ TAB: KELOLA KATEGORI ══ --}}
@if($activeTab==='categories')
<div class="stats-grid" style="margin-bottom:0">
  <div class="stat-card"><div class="stat-label">Total Kategori</div><div class="stat-num">{{ $categories->count() }}</div><div class="stat-sub">Kategori terdaftar</div></div>
  <div class="stat-card"><div class="stat-label">Buku Terkategori</div><div class="stat-num green">{{ $books->total() }}</div><div class="stat-sub">dari semua koleksi</div></div>
</div>
<div class="table-wrap">
  <div class="table-toolbar">
    <form class="tb-search" method="GET" action="{{ route('admin.books.index') }}">
      <input type="hidden" name="tab" value="categories">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" style="color:var(--muted-2);flex-shrink:0"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <input name="cat_search" placeholder="Cari nama kategori..." value="{{ request('cat_search') }}">
    </form>
    <div class="tb-spacer"></div>
    <button type="button" class="btn-primary" onclick="openModal('add-category')">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
      Tambah Kategori
    </button>
  </div>
  <table>
    <thead><tr><th>#</th><th>Nama Kategori</th><th>Slug</th><th>Deskripsi</th><th>Jumlah Buku</th><th>Dibuat</th><th style="text-align:right">Aksi</th></tr></thead>
    <tbody>
      @forelse($categories as $cat)
      <tr>
        <td style="color:var(--muted-2);font-size:.72rem">KT-{{ str_pad($cat->id,2,'0',STR_PAD_LEFT) }}</td>
        <td style="font-weight:600;font-size:.82rem">{{ $cat->name }}</td>
        <td><span style="font-size:.7rem;font-family:monospace;background:var(--surface);border:1px solid var(--border);padding:2px 7px;border-radius:4px;color:var(--muted)">{{ $cat->slug }}</span></td>
        <td style="font-size:.76rem;color:var(--muted)">{{ Str::limit($cat->description,40) ?? '—' }}</td>
        <td><strong>{{ $cat->books_count ?? $cat->books()->count() }}</strong> <span style="font-size:.67rem;color:var(--muted-2)">buku</span></td>
        <td style="font-size:.72rem;color:var(--muted-2)">{{ $cat->created_at->format('d M Y') }}</td>
        <td>
          <div class="row-actions">
            <button type="button" class="action-btn" title="Edit" onclick="openEditCategory({{ $cat->id }},'{{ addslashes($cat->name) }}','{{ addslashes($cat->slug) }}','{{ addslashes($cat->description ?? '') }}')">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            </button>
            <button type="button" class="action-btn danger" title="Hapus" onclick="openDeleteCategory({{ $cat->id }},'{{ addslashes($cat->name) }}',{{ $cat->books_count ?? 0 }})">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
            </button>
          </div>
        </td>
      </tr>
      @empty
      <tr><td colspan="7" style="text-align:center;padding:48px;color:var(--muted-2);font-size:.82rem">Tidak ada kategori.</td></tr>
      @endforelse
    </tbody>
  </table>
  <div class="pagination">
    <span class="pag-info">Total {{ $categories->count() }} kategori terdaftar</span>
  </div>
</div>
@endif

{{-- ══ TAB: PERSETUJUAN ══ --}}
@if($activeTab==='proposals' && auth()->user()->role==='admin')
@php
  $proposals     = \App\Models\BookProposal::with(['user','category'])->latest()->paginate(15);
  $pendingCount  = \App\Models\BookProposal::pending()->count();
  $approvedMonth = \App\Models\BookProposal::approved()->whereMonth('reviewed_at',now()->month)->count();
  $rejectedMonth = \App\Models\BookProposal::rejected()->whereMonth('reviewed_at',now()->month)->count();
@endphp
<div class="stats-grid cols3">
  <div class="stat-card"><div class="stat-label">Menunggu</div><div class="stat-num amber">{{ $pendingCount }}</div><div class="stat-sub">Diusulkan petugas</div></div>
  <div class="stat-card"><div class="stat-label">Disetujui Bulan Ini</div><div class="stat-num green">{{ $approvedMonth }}</div><div class="stat-sub">Buku berhasil ditambahkan</div></div>
  <div class="stat-card"><div class="stat-label">Ditolak Bulan Ini</div><div class="stat-num red">{{ $rejectedMonth }}</div><div class="stat-sub">Tidak memenuhi syarat</div></div>
</div>
<div class="table-wrap">
  <div class="table-head">
    <div class="table-title">Usulan Buku dari Petugas</div>
    <form method="GET" action="{{ route('admin.books.index') }}">
      <input type="hidden" name="tab" value="proposals">
      <select class="tb-select" name="proposal_status" style="height:30px;font-size:.72rem" onchange="this.form.submit()">
        <option value="">Semua Status</option>
        <option value="pending" {{ request('proposal_status')==='pending'?'selected':'' }}>Menunggu</option>
        <option value="approved" {{ request('proposal_status')==='approved'?'selected':'' }}>Disetujui</option>
        <option value="rejected" {{ request('proposal_status')==='rejected'?'selected':'' }}>Ditolak</option>
      </select>
    </form>
  </div>
  <table>
    <thead><tr><th>#</th><th>Judul Buku</th><th>Penulis</th><th>Kategori</th><th>Diusulkan Oleh</th><th>Tgl Usulan</th><th>Status</th><th style="text-align:right">Aksi</th></tr></thead>
    <tbody>
      @forelse($proposals as $p)
      <tr style="{{ in_array($p->status,['approved','rejected'])?'opacity:.8':'' }}">
        <td style="color:var(--muted-2);font-size:.72rem">USL-{{ str_pad($p->id,3,'0',STR_PAD_LEFT) }}</td>
        <td>
          <div style="font-weight:500">{{ Str::limit($p->title,30) }}</div>
          @if($p->isbn)<div style="font-size:.68rem;color:var(--muted-2)">ISBN: {{ $p->isbn }}</div>@endif
        </td>
        <td>{{ $p->author }}</td>
        <td><span class="badge badge-muted">{{ $p->category->name ?? '—' }}</span></td>
        <td>
          <div style="display:flex;align-items:center;gap:6px">
            <div class="mini-av" style="background:var(--accent-pale);color:var(--accent)">{{ strtoupper(substr($p->user->name,0,2)) }}</div>
            <span style="font-size:.78rem">{{ $p->user->name }}</span>
          </div>
        </td>
        <td style="font-size:.72rem;color:var(--muted-2)">{{ $p->created_at->format('d M Y') }}</td>
        <td>
          <span class="badge {{ $p->status==='pending'?'badge-amber':($p->status==='approved'?'badge-green':'badge-red') }}">
            {{ $p->status==='pending'?'Menunggu':($p->status==='approved'?'Disetujui':'Ditolak') }}
          </span>
        </td>
        <td>
          <div class="row-actions">
            @if($p->status==='pending')
              <button type="button" class="action-btn success" title="Setujui" onclick="openApproveModal({{ $p->id }},'{{ addslashes($p->title) }}','{{ addslashes($p->author) }}','{{ $p->category->name ?? '' }}','{{ $p->isbn ?? '' }}','{{ addslashes($p->user->name) }}','{{ $p->created_at->format('d M Y') }}')">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
              </button>
              <button type="button" class="action-btn danger" title="Tolak" onclick="openRejectModal({{ $p->id }},'{{ addslashes($p->title) }}','{{ addslashes($p->user->name) }}','{{ $p->created_at->format('d M Y') }}')">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
              </button>
            @endif
          </div>
        </td>
      </tr>
      @empty
      <tr><td colspan="8" style="text-align:center;padding:48px;color:var(--muted-2);font-size:.82rem">Tidak ada usulan.</td></tr>
      @endforelse
    </tbody>
  </table>
  <div class="pagination">
    <span class="pag-info">Menampilkan {{ $proposals->firstItem() }}–{{ $proposals->lastItem() }} dari {{ $proposals->total() }} usulan</span>
    <div class="pag-btns">
      @if($proposals->onFirstPage())<span class="pag-btn disabled">‹</span>@else<a href="{{ $proposals->appends(request()->except('page'))->previousPageUrl() }}&tab=proposals" class="pag-btn">‹</a>@endif
      @foreach($proposals->appends(request()->except('page'))->getUrlRange(1,$proposals->lastPage()) as $page => $url)
        <a href="{{ $url }}&tab=proposals" class="pag-btn {{ $page==$proposals->currentPage()?'active':'' }}">{{ $page }}</a>
      @endforeach
      @if($proposals->hasMorePages())<a href="{{ $proposals->appends(request()->except('page'))->nextPageUrl() }}&tab=proposals" class="pag-btn">›</a>@else<span class="pag-btn disabled">›</span>@endif
    </div>
  </div>
</div>
@endif

{{-- ══ MODALS ══ --}}

{{-- Hapus Buku --}}
<div id="modal-delete-book" class="modal-overlay" onclick="handleOverlayClick(event,'delete-book')">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title" style="color:var(--red)">Hapus Buku</div>
      <button type="button" class="modal-close" onclick="closeModal('delete-book')"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
    </div>
    <div class="modal-body">
      <div class="modal-book-row">
        <div class="mini-cover" style="background:linear-gradient(150deg,var(--accent),var(--accent-dark));display:flex;align-items:center;justify-content:center"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.5)" stroke-width="1.75"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg></div>
        <div><div style="font-weight:600;font-size:.84rem" id="del-book-title">—</div></div>
      </div>
      <div class="notice-amber modal-notice"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;margin-top:1px"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/></svg><span>Buku akan dihapus permanen. Aksi ini tidak dapat dibatalkan.</span></div>
    </div>
    <div class="modal-footer">
      <form id="del-book-form" method="POST">@csrf @method('DELETE')
        <button type="submit" class="modal-btn-danger">Ya, Hapus Buku</button>
      </form>
      <button type="button" class="modal-btn-cancel" onclick="closeModal('delete-book')">Batal</button>
    </div>
  </div>
</div>

{{-- Tambah Kategori --}}
<div id="modal-add-category" class="modal-overlay" onclick="handleOverlayClick(event,'add-category')">
  <div class="modal wide">
    <div class="modal-header">
      <div><div class="modal-title">Tambah Kategori</div><div style="font-size:.72rem;color:var(--muted);margin-top:2px">Buat kategori baru untuk pengelompokan koleksi</div></div>
      <button type="button" class="modal-close" onclick="closeModal('add-category')"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
    </div>
    <form method="POST" action="{{ route('admin.categories.store') }}">
      @csrf
      <div class="modal-body">
        <div class="modal-fields">
          <div><label class="m-field-label">Nama Kategori <span style="color:var(--red)">*</span></label><input class="m-input" name="name" placeholder="cth. Biografi, Agama, Olahraga..." required/></div>
          <div><label class="m-field-label">Deskripsi</label><textarea class="m-textarea" name="description" rows="2" placeholder="Jelaskan jenis buku yang termasuk kategori ini (opsional)..."></textarea></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="modal-btn-ok"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Simpan Kategori</button>
        <button type="button" class="modal-btn-cancel" onclick="closeModal('add-category')">Batal</button>
      </div>
    </form>
  </div>
</div>

{{-- Edit Kategori --}}
<div id="modal-edit-category" class="modal-overlay" onclick="handleOverlayClick(event,'edit-category')">
  <div class="modal wide">
    <div class="modal-header">
      <div><div class="modal-title">Edit Kategori</div><div style="font-size:.72rem;color:var(--muted);margin-top:2px" id="edit-cat-sub">—</div></div>
      <button type="button" class="modal-close" onclick="closeModal('edit-category')"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
    </div>
    <form id="edit-cat-form" method="POST">
      @csrf @method('PUT')
      <div class="modal-body">
        <div class="modal-fields">
          <div><label class="m-field-label">Nama Kategori <span style="color:var(--red)">*</span></label><input class="m-input" id="edit-cat-name" name="name" required/></div>
          <div><label class="m-field-label">Deskripsi</label><textarea class="m-textarea" id="edit-cat-desc" name="description" rows="2"></textarea></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="modal-btn-ok">Simpan Perubahan</button>
        <button type="button" class="modal-btn-cancel" onclick="closeModal('edit-category')">Batal</button>
      </div>
    </form>
  </div>
</div>

{{-- Hapus Kategori --}}
<div id="modal-delete-category" class="modal-overlay" onclick="handleOverlayClick(event,'delete-category')">
  <div class="modal">
    <div class="modal-header"><div class="modal-title" style="color:var(--red)">Hapus Kategori</div><button type="button" class="modal-close" onclick="closeModal('delete-category')"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button></div>
    <div class="modal-body">
      <div style="display:flex;align-items:center;gap:12px;padding:13px;background:var(--surface);border:1px solid var(--border);border-radius:10px">
        <div style="font-weight:600;font-size:.84rem" id="del-cat-name">—</div>
        <span class="badge badge-muted" id="del-cat-count" style="margin-left:auto">0 buku</span>
      </div>
      <div class="notice-amber modal-notice"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;margin-top:1px"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/></svg><span id="del-cat-warn">Buku akan kehilangan kategorinya. Aksi ini tidak dapat dibatalkan.</span></div>
    </div>
    <div class="modal-footer">
      <form id="del-cat-form" method="POST">@csrf @method('DELETE')
        <button type="submit" class="modal-btn-danger">Ya, Hapus Kategori</button>
      </form>
      <button type="button" class="modal-btn-cancel" onclick="closeModal('delete-category')">Batal</button>
    </div>
  </div>
</div>

{{-- Setujui Usulan --}}
<div id="modal-approve-book" class="modal-overlay" onclick="handleOverlayClick(event,'approve-book')">
  <div class="modal">
    <div class="modal-header">
      <div><div class="modal-title" style="color:var(--green)">Setujui Usulan Buku</div><div style="font-size:.72rem;color:var(--muted);margin-top:2px">Buku akan langsung ditambahkan ke koleksi</div></div>
      <button type="button" class="modal-close" onclick="closeModal('approve-book')"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
    </div>
    <div class="modal-body">
      <div class="modal-book-row">
        <div class="mini-cover" style="background:linear-gradient(150deg,var(--accent),var(--accent-dark));display:flex;align-items:center;justify-content:center"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.5)" stroke-width="1.75"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg></div>
        <div>
          <div style="font-weight:600;font-size:.84rem" id="apr-book-title">—</div>
          <div style="font-size:.7rem;color:var(--muted-2)" id="apr-book-meta">—</div>
          <div style="font-size:.68rem;color:var(--muted-2);margin-top:3px" id="apr-book-who">—</div>
        </div>
      </div>
      <form id="approve-form" method="POST">
        @csrf
        <div><label class="m-field-label">Stok Awal <span style="color:var(--red)">*</span></label><input class="m-input" type="number" name="stock" value="2" min="1" required/><div style="font-size:.65rem;color:var(--muted-2);margin-top:3px">Jumlah eksemplar tersedia.</div></div>
        <div style="margin-top:12px"><label class="m-field-label">Catatan untuk Petugas <span style="color:var(--muted-2);font-weight:400;text-transform:none">(opsional)</span></label><textarea class="m-textarea" name="admin_note" rows="2" placeholder="cth. Stok disesuaikan menjadi 2..."></textarea></div>
      </form>
    </div>
    <div class="modal-footer">
      <button type="submit" form="approve-form" class="modal-btn-ok"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>Ya, Setujui</button>
      <button type="button" class="modal-btn-cancel" onclick="closeModal('approve-book')">Batal</button>
    </div>
  </div>
</div>

{{-- Tolak Usulan --}}
<div id="modal-reject-book" class="modal-overlay" onclick="handleOverlayClick(event,'reject-book')">
  <div class="modal">
    <div class="modal-header">
      <div><div class="modal-title" style="color:var(--red)">Tolak Usulan Buku</div><div style="font-size:.72rem;color:var(--muted);margin-top:2px">Berikan alasan penolakan untuk petugas</div></div>
      <button type="button" class="modal-close" onclick="closeModal('reject-book')"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
    </div>
    <div class="modal-body">
      <div class="modal-book-row">
        <div class="mini-cover" style="background:linear-gradient(150deg,var(--accent),var(--accent-dark));display:flex;align-items:center;justify-content:center"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.5)" stroke-width="1.75"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg></div>
        <div><div style="font-weight:600;font-size:.84rem" id="rej-book-title">—</div><div style="font-size:.7rem;color:var(--muted-2)" id="rej-book-who">—</div></div>
      </div>
      <form id="reject-form" method="POST">
        @csrf
        <div><label class="m-field-label">Alasan Penolakan <span style="color:var(--red)">*</span></label><textarea class="m-textarea" name="admin_note" rows="3" placeholder="cth. Buku duplikat, sudah ada di koleksi..." required></textarea><div style="font-size:.65rem;color:var(--muted-2);margin-top:3px">Alasan ini akan dikirim ke petugas sebagai notifikasi.</div></div>
      </form>
      <div class="notice-amber modal-notice"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;margin-top:1px"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/></svg><span>Status usulan akan berubah menjadi <strong>Ditolak</strong>. Petugas dapat mengajukan ulang.</span></div>
    </div>
    <div class="modal-footer">
      <button type="submit" form="reject-form" class="modal-btn-danger"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>Ya, Tolak</button>
      <button type="button" class="modal-btn-cancel" onclick="closeModal('reject-book')">Batal</button>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
function openDeleteModal(id,title){
  document.getElementById('del-book-title').textContent=title;
  document.getElementById('del-book-form').action='/admin/books/'+id;
  openModal('delete-book');
}
function openEditCategory(id,name,slug,desc){
  document.getElementById('edit-cat-name').value=name;
  document.getElementById('edit-cat-desc').value=desc;
  document.getElementById('edit-cat-sub').textContent='Slug: '+slug;
  document.getElementById('edit-cat-form').action='/admin/categories/'+id;
  openModal('edit-category');
}
function openDeleteCategory(id,name,count){
  document.getElementById('del-cat-name').textContent=name;
  document.getElementById('del-cat-count').textContent=count+' buku';
  document.getElementById('del-cat-warn').innerHTML='<strong>'+count+' buku</strong> akan kehilangan kategorinya. Aksi ini tidak dapat dibatalkan.';
  document.getElementById('del-cat-form').action='/admin/categories/'+id;
  openModal('delete-category');
}
function openApproveModal(id,title,author,cat,isbn,user,date){
  document.getElementById('apr-book-title').textContent=title;
  document.getElementById('apr-book-meta').textContent=author+' · '+cat+(isbn?' · ISBN: '+isbn:'');
  document.getElementById('apr-book-who').textContent='Diusulkan oleh '+user+' · '+date;
  document.getElementById('approve-form').action='/admin/books/proposals/'+id+'/approve';
  openModal('approve-book');
}
function openRejectModal(id,title,user,date){
  document.getElementById('rej-book-title').textContent=title;
  document.getElementById('rej-book-who').textContent='Diusulkan oleh '+user+' · '+date;
  document.getElementById('reject-form').action='/admin/books/proposals/'+id+'/reject';
  openModal('reject-book');
}
</script>
@endpush
