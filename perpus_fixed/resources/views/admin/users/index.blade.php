@extends('layouts.admin')
@section('title', 'Kelola Akun')
@section('page-title', 'Kelola Akun')
@section('page-subtitle', 'Manajemen pengguna & aktivasi akun')

@section('content')

<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-label">Total Peminjam</div>
    <div class="stat-num">{{ number_format($stats['total_user']) }}</div>
    <div class="stat-sub">Pengguna terdaftar</div>
  </div>
  <div class="stat-card">
    <div class="stat-label">Akun Aktif</div>
    <div class="stat-num green">{{ number_format($stats['aktif']) }}</div>
    <div class="stat-sub">Bisa melakukan peminjaman</div>
  </div>
  <div class="stat-card">
    <div class="stat-label">Menunggu Aktivasi</div>
    <div class="stat-num amber">{{ number_format($stats['nonaktif']) }}</div>
    <div class="stat-sub">Perlu konfirmasi admin</div>
  </div>
  <div class="stat-card">
    <div class="stat-label">Total Staf</div>
    <div class="stat-num" style="color:var(--blue)">{{ number_format($stats['total_petugas']) }}</div>
    <div class="stat-sub">Admin & petugas aktif</div>
  </div>
</div>

<div class="page-tabs">
  <a href="{{ route('admin.users.index', ['role' => 'user']) }}"
     class="ptab {{ $role === 'user' ? 'active' : '' }}">
    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
    Peminjam <span class="ptab-cnt">{{ $counts['user'] }}</span>
  </a>
  <a href="{{ route('admin.users.index', ['role' => 'petugas']) }}"
     class="ptab {{ $role === 'petugas' ? 'active' : '' }}">
    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
    Petugas <span class="ptab-cnt">{{ $counts['petugas'] }}</span>
  </a>
  <a href="{{ route('admin.users.index', ['role' => 'admin']) }}"
     class="ptab {{ $role === 'admin' ? 'active' : '' }}">
    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
    Admin <span class="ptab-cnt">{{ $counts['admin'] }}</span>
  </a>
</div>

@if($role === 'user')
<div class="page-tabs" style="margin-top:-10px">
  <a href="{{ route('admin.users.index', ['role' => 'user']) }}"
     class="ptab {{ !request('status') ? 'active' : '' }}">
    Semua <span class="ptab-cnt">{{ $counts['user'] }}</span>
  </a>
  <a href="{{ route('admin.users.index', ['role' => 'user', 'status' => 'aktif']) }}"
     class="ptab {{ request('status') === 'aktif' ? 'active' : '' }}">
    Aktif <span class="ptab-cnt">{{ $stats['aktif'] }}</span>
  </a>
  <a href="{{ route('admin.users.index', ['role' => 'user', 'status' => 'nonaktif']) }}"
     class="ptab {{ request('status') === 'nonaktif' ? 'active' : '' }}">
    Menunggu Aktivasi
    <span class="ptab-cnt {{ $stats['nonaktif'] > 0 ? 'warn' : '' }}">{{ $stats['nonaktif'] }}</span>
  </a>
</div>
@endif

<div class="table-wrap">
  <div class="table-toolbar">
    <form method="GET" action="{{ route('admin.users.index') }}" style="display:contents">
      <input type="hidden" name="role" value="{{ $role }}">
      @if(request('status'))<input type="hidden" name="status" value="{{ request('status') }}">@endif
      <div class="tb-search">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" style="color:var(--muted-2);flex-shrink:0"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <input name="search" value="{{ request('search') }}" placeholder="Cari nama, email, username...">
      </div>
      <button type="submit" class="btn-secondary" style="height:32px;padding:0 12px;font-size:.65rem">Cari</button>
    </form>
    <div class="tb-spacer"></div>
    @if($role === 'petugas')
    <button class="btn-primary" style="height:32px;padding:0 14px;font-size:.65rem" onclick="openModal('tambah-petugas')">
      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
      Tambah Petugas
    </button>
    @endif
  </div>

  @if($role === 'user')
  <div style="padding:10px 16px;background:var(--surface);border-bottom:1px solid var(--border);font-size:.77rem;color:var(--muted);display:flex;align-items:center;gap:8px">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
    Akun peminjam dibuat sendiri oleh pengguna saat registrasi. Admin hanya dapat mengaktifkan, mengedit, atau menghapus akun.
  </div>
  @elseif($role === 'admin')
  <div style="padding:10px 16px;background:var(--amber-pale);border-bottom:1px solid var(--amber-border);font-size:.77rem;color:var(--amber);display:flex;align-items:center;gap:8px">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
    Daftar akun admin sistem. Akun admin tidak dapat ditambah dari halaman ini.
  </div>
  @endif

  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Kota</th>
        <th>No. HP</th>
        @if($role === 'user')<th>Status</th>@endif
        <th>Terdaftar</th>
        <th style="text-align:right">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($users as $u)
      @php
        $initials = collect(explode(' ', $u->name))->take(2)->map(fn($w) => strtoupper($w[0] ?? ''))->implode('');
        $avColors = [['#eaf3ee','var(--green)'],['#f0e6f6','#7b2d8b'],['var(--blue-pale)','var(--blue)'],['var(--amber-pale)','var(--amber)'],['#fce4ec','#c62828']];
        $av = $avColors[$u->id % count($avColors)];
      @endphp
      <tr>
        <td style="color:var(--muted-2);font-size:.75rem">{{ $users->firstItem() + $loop->index }}</td>
        <td>
          <div style="display:flex;align-items:center;gap:9px">
            <div style="width:28px;height:28px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.58rem;font-weight:700;flex-shrink:0;background:{{ $av[0] }};color:{{ $av[1] }}">{{ $initials }}</div>
            <div>
              <div style="font-weight:500;font-size:.82rem">{{ $u->name }}</div>
              <div style="font-size:.67rem;color:var(--muted-2)">@{{ $u->username }}</div>
            </div>
          </div>
        </td>
        <td style="font-size:.78rem;color:var(--muted)">{{ $u->email }}</td>
        <td style="font-size:.78rem;color:var(--muted-2)">{{ $u->city ?? '—' }}</td>
        <td style="font-size:.78rem;color:var(--muted-2)">{{ $u->phone ?? '—' }}</td>
        @if($role === 'user')
        <td>
          @if($u->is_active)
            <span class="badge badge-green">Aktif</span>
          @else
            <span class="badge badge-amber">Menunggu</span>
          @endif
        </td>
        @endif
        <td style="font-size:.75rem;color:var(--muted-2)">{{ $u->created_at->format('d M Y') }}</td>
        <td>
          <div class="row-actions">
            @if($role === 'user')
              @if(!$u->is_active)
              <form method="POST" action="{{ route('admin.users.activate', $u) }}">@csrf
                <button type="submit" class="action-btn success" title="Aktifkan Akun">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                </button>
              </form>
              @else
              <form method="POST" action="{{ route('admin.users.activate', $u) }}">@csrf
                <button type="submit" class="action-btn" title="Nonaktifkan Akun"
                  onclick="return confirm('Nonaktifkan akun {{ addslashes($u->name) }}?')">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                </button>
              </form>
              @endif
            @endif

            <button class="action-btn" title="Edit Akun"
              onclick="openEditModal({{ $u->id }},'{{ addslashes($u->name) }}','{{ addslashes($u->username) }}','{{ addslashes($u->email) }}','{{ addslashes($u->phone ?? '') }}','{{ addslashes($u->city ?? '') }}')">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            </button>

            @if($u->id !== auth()->id() && $u->role !== 'admin')
            <form method="POST" action="{{ route('admin.users.destroy', $u) }}">
              @csrf @method('DELETE')
              <button type="submit" class="action-btn danger" title="Hapus Akun"
                onclick="return confirm('Hapus akun {{ addslashes($u->name) }}? Tindakan ini tidak bisa dibatalkan.')">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
              </button>
            </form>
            @endif
          </div>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="{{ $role === 'user' ? 8 : 7 }}" style="text-align:center;padding:60px;color:var(--muted-2);font-size:.82rem">
          Tidak ada akun yang cocok dengan filter yang dipilih.
        </td>
      </tr>
      @endforelse
    </tbody>
  </table>

  @if($users->hasPages())
  <div class="pagination">
    <span class="pag-info">Menampilkan {{ $users->firstItem() }}–{{ $users->lastItem() }} dari {{ $users->total() }} akun</span>
    <div class="pag-btns">
      @if($users->onFirstPage())
        <span class="pag-btn disabled">‹</span>
      @else
        <a href="{{ $users->appends(request()->query())->previousPageUrl() }}" class="pag-btn">‹</a>
      @endif
      @foreach($users->appends(request()->query())->getUrlRange(max(1,$users->currentPage()-2),min($users->lastPage(),$users->currentPage()+2)) as $page => $url)
        <a href="{{ $url }}" class="pag-btn {{ $page==$users->currentPage()?'active':'' }}">{{ $page }}</a>
      @endforeach
      @if($users->hasMorePages())
        <a href="{{ $users->appends(request()->query())->nextPageUrl() }}" class="pag-btn">›</a>
      @else
        <span class="pag-btn disabled">›</span>
      @endif
    </div>
  </div>
  @endif
</div>

{{-- MODAL TAMBAH PETUGAS --}}
<div id="modal-tambah-petugas" class="modal-overlay" onclick="handleOverlayClick(event,'tambah-petugas')">
  <div class="modal wide">
    <div class="modal-header">
      <div class="modal-title">Tambah Akun Petugas</div>
      <button type="button" class="modal-close" onclick="closeModal('tambah-petugas')">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </button>
    </div>
    <form method="POST" action="{{ route('admin.users.store') }}">
      @csrf
      <input type="hidden" name="role" value="petugas">
      <div class="modal-body">
        <div class="modal-notice notice-blue" style="margin-bottom:14px">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
          Akun yang dibuat di sini akan otomatis mendapat role <strong>Petugas</strong> dan langsung aktif.
        </div>
        <div class="modal-fields">
          <div>
            <label class="m-field-label">Nama Lengkap <span style="color:var(--red)">*</span></label>
            <input name="name" class="m-input" placeholder="Nama lengkap petugas..." required>
          </div>
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px">
            <div>
              <label class="m-field-label">Username <span style="color:var(--red)">*</span></label>
              <input name="username" class="m-input" placeholder="Username unik..." required>
            </div>
            <div>
              <label class="m-field-label">Email <span style="color:var(--red)">*</span></label>
              <input name="email" type="email" class="m-input" placeholder="email@contoh.com" required>
            </div>
          </div>
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px">
            <div>
              <label class="m-field-label">No. HP</label>
              <input name="phone" class="m-input" placeholder="08xx...">
            </div>
            <div>
              <label class="m-field-label">Kota</label>
              <input name="city" class="m-input" placeholder="Kota domisili...">
            </div>
          </div>
          <div>
            <label class="m-field-label">Password <span style="color:var(--red)">*</span></label>
            <input name="password" type="password" class="m-input" placeholder="Min. 6 karakter..." required minlength="6">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="modal-btn-cancel" onclick="closeModal('tambah-petugas')">Batal</button>
        <button type="submit" class="modal-btn-ok">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          Tambah Petugas
        </button>
      </div>
    </form>
  </div>
</div>

{{-- MODAL EDIT AKUN --}}
<div id="modal-edit-akun" class="modal-overlay" onclick="handleOverlayClick(event,'edit-akun')">
  <div class="modal wide">
    <div class="modal-header">
      <div class="modal-title">Edit Akun</div>
      <button type="button" class="modal-close" onclick="closeModal('edit-akun')">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </button>
    </div>
    <form method="POST" id="formEdit">
      @csrf @method('PUT')
      <div class="modal-body">
        <div class="modal-fields">
          <div>
            <label class="m-field-label">Nama Lengkap <span style="color:var(--red)">*</span></label>
            <input name="name" id="edit_name" class="m-input" required>
          </div>
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px">
            <div>
              <label class="m-field-label">Username <span style="color:var(--red)">*</span></label>
              <input name="username" id="edit_username" class="m-input" required>
            </div>
            <div>
              <label class="m-field-label">Email <span style="color:var(--red)">*</span></label>
              <input name="email" id="edit_email" type="email" class="m-input" required>
            </div>
          </div>
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px">
            <div>
              <label class="m-field-label">No. HP</label>
              <input name="phone" id="edit_phone" class="m-input">
            </div>
            <div>
              <label class="m-field-label">Kota</label>
              <input name="city" id="edit_city" class="m-input">
            </div>
          </div>
          <div>
            <label class="m-field-label">Password Baru
              <span style="color:var(--muted-2);font-weight:400;text-transform:none;letter-spacing:0;font-size:.68rem">(kosongkan jika tidak diubah)</span>
            </label>
            <input name="password" type="password" class="m-input" placeholder="Password baru...">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="modal-btn-cancel" onclick="closeModal('edit-akun')">Batal</button>
        <button type="submit" class="modal-btn-ok">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
          Simpan Perubahan
        </button>
      </div>
    </form>
  </div>
</div>

@endsection

@push('scripts')
<script>
function openEditModal(id, name, username, email, phone, city) {
  document.getElementById('edit_name').value     = name;
  document.getElementById('edit_username').value = username;
  document.getElementById('edit_email').value    = email;
  document.getElementById('edit_phone').value    = phone;
  document.getElementById('edit_city').value     = city;
  document.getElementById('formEdit').action     = '/admin/users/' + id;
  openModal('edit-akun');
}
</script>
@endpush