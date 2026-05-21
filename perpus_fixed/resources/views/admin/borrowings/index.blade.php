@extends('layouts.admin')
@section('title','Peminjaman & Pengembalian')
@section('page-title','Peminjaman')
@section('page-subtitle','Kelola transaksi peminjaman dan pengembalian')

@section('content')

{{-- ── TABS ── --}}
<div class="page-tabs">
  @php $tabs = ['borrowing'=>'Peminjaman','returning'=>'Pengajuan Kembali','returned'=>'Sudah Kembali','rejected'=>'Ditolak'] @endphp
  @foreach($tabs as $t => $label)
  <a class="ptab {{ $tab===$t?'active':'' }}" href="{{ route('admin.borrowings.index',['tab'=>$t]) }}">{{ $label }}</a>
  @endforeach
</div>

<div class="table-wrap">
  <form class="table-toolbar" method="GET" action="{{ route('admin.borrowings.index') }}">
    <input type="hidden" name="tab" value="{{ $tab }}">
    <div class="tb-search">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" style="color:var(--muted-2);flex-shrink:0"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <input type="search" name="search" placeholder="Cari nama / judul buku..." value="{{ request('search') }}">
    </div>
    <input type="date" name="from" class="tb-select" style="height:32px;padding:0 10px" value="{{ request('from') }}" title="Dari tanggal">
    <input type="date" name="to"   class="tb-select" style="height:32px;padding:0 10px" value="{{ request('to') }}"   title="Sampai tanggal">
    <button type="submit" class="btn-secondary" style="height:32px;padding:0 14px;font-size:.65rem">
      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      Filter
    </button>
    @if(request()->anyFilled(['search','from','to']))
      <a href="{{ route('admin.borrowings.index', ['tab'=>$tab]) }}" class="btn-secondary" style="height:32px;padding:0 14px;font-size:.65rem">Reset</a>
    @endif
  </form>

  <table>
    <thead>
      <tr>
        <th>User</th><th>Buku</th><th>Tgl Pinjam</th><th>Tgl Kembali</th><th>Kondisi</th><th>Status</th><th style="text-align:right">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($data as $b)
      <tr>
        <td>
          <div style="font-weight:600;font-size:.82rem">{{ $b->user->name }}</div>
          <div style="font-size:.7rem;color:var(--muted)">{{ $b->user->city }}</div>
          @if($b->user_note)
            <div style="font-size:.68rem;color:var(--muted-2);margin-top:2px;font-style:italic">💬 {{ Str::limit($b->user_note, 30) }}</div>
          @endif
        </td>
        <td>
          <div style="font-size:.82rem;font-weight:500">{{ Str::limit($b->book->title,28) }}</div>
          <div style="font-size:.7rem;color:var(--muted)">{{ $b->book->author }}</div>
        </td>
        <td style="font-size:.75rem;color:var(--muted)">{{ $b->borrow_date->format('d/m/Y') }}</td>
        <td>
          <div style="font-size:.75rem">{{ $b->return_date->format('d/m/Y') }}</div>
          @if($b->status==='approved' && $b->isLate())
            <span class="badge badge-red" style="margin-top:3px;display:inline-flex">Telat {{ $b->lateDays() }}h</span>
          @endif
        </td>
        <td>
          @php
            $condLabel = ['normal'=>'Normal','rusak_ringan'=>'Rusak Ringan','rusak_berat'=>'Rusak Berat'];
            $condBadge = ['normal'=>'badge-green','rusak_ringan'=>'badge-amber','rusak_berat'=>'badge-red'];
          @endphp
          <span class="badge {{ $condBadge[$b->condition] ?? 'badge-muted' }}">
            {{ $condLabel[$b->condition] ?? ucfirst($b->condition) }}
          </span>
        </td>
        <td>
          @php $sm=['pending'=>'badge-amber','approved'=>'badge-blue','returning'=>'badge-amber','returned'=>'badge-muted','rejected'=>'badge-red'] @endphp
          <span class="badge {{ $sm[$b->status]??'badge-muted' }}">{{ $b->status_label }}</span>
        </td>
        <td>
          <div class="row-actions">
            @if($b->status==='pending')
              <form method="POST" action="{{ route('admin.borrowings.approve',$b) }}">@csrf
                <button type="submit" class="btn-primary" style="height:28px;padding:0 10px;font-size:.63rem"
                  onclick="return confirm('Setujui peminjaman ini?')">✓ Setuju</button>
              </form>
              <button type="button" class="btn-danger" style="height:28px;padding:0 10px;font-size:.63rem"
                onclick="openModal('reject-{{ $b->id }}')">✗ Tolak</button>
            @endif
            @if($b->status==='returning')
              <form method="POST" action="{{ route('admin.borrowings.approve-return',$b) }}">@csrf
                <button type="submit" class="btn-primary" style="height:28px;padding:0 10px;font-size:.63rem"
                  onclick="return confirm('Setujui pengembalian? Denda dihitung otomatis.')">✓ Setuju</button>
              </form>
              <button type="button" class="btn-danger" style="height:28px;padding:0 10px;font-size:.63rem"
                onclick="openModal('reject-return-{{ $b->id }}')">✗ Tolak</button>
            @endif
            @if($b->admin_note)
              <span class="badge badge-muted" title="{{ $b->admin_note }}" style="cursor:help;max-width:140px;overflow:hidden;text-overflow:ellipsis">
                💬 {{ Str::limit($b->admin_note, 20) }}
              </span>
            @endif
            @if($b->fine_amount > 0)
              <span class="badge badge-amber">Denda Rp {{ number_format($b->fine_amount,0,',','.') }}</span>
            @endif
          </div>
        </td>
      </tr>
      @empty
      <tr><td colspan="7" style="text-align:center;padding:48px 0;color:var(--muted-2);font-size:.82rem">Tidak ada data.</td></tr>
      @endforelse
    </tbody>
  </table>

  <div class="pagination">
    <span class="pag-info">{{ $data->total() }} transaksi</span>
    <div class="pag-btns">
      @if($data->onFirstPage())
        <span class="pag-btn disabled">‹</span>
      @else
        <a href="{{ $data->appends(request()->query())->previousPageUrl() }}" class="pag-btn">‹</a>
      @endif
      @foreach($data->appends(request()->query())->getUrlRange(max(1,$data->currentPage()-2),min($data->lastPage(),$data->currentPage()+2)) as $page => $url)
        <a href="{{ $url }}" class="pag-btn {{ $page==$data->currentPage()?'active':'' }}">{{ $page }}</a>
      @endforeach
      @if($data->hasMorePages())
        <a href="{{ $data->appends(request()->query())->nextPageUrl() }}" class="pag-btn">›</a>
      @else
        <span class="pag-btn disabled">›</span>
      @endif
    </div>
  </div>
</div>

{{-- ══ MODALS — di luar table, pakai sistem modal custom admin layout ══ --}}
@foreach($data as $b)

  @if($b->status==='pending')
  <div id="modal-reject-{{ $b->id }}" class="modal-overlay" onclick="handleOverlayClick(event,'reject-{{ $b->id }}')">
    <div class="modal">
      <div class="modal-header">
        <div>
          <div class="modal-title">Tolak Peminjaman</div>
          <div style="font-size:.72rem;color:var(--muted);margin-top:2px">{{ Str::limit($b->book->title, 40) }} &bull; {{ $b->user->name }}</div>
        </div>
        <button type="button" class="modal-close" onclick="closeModal('reject-{{ $b->id }}')">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
      </div>
      <form method="POST" action="{{ route('admin.borrowings.reject',$b) }}">@csrf
        <div class="modal-body">
          <div class="modal-notice notice-amber">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            Peminjaman akan ditolak dan tidak bisa dibatalkan.
          </div>
          <div>
            <label class="m-field-label">Alasan penolakan <span style="color:var(--muted-2);font-weight:400;text-transform:none;letter-spacing:0">(opsional)</span></label>
            <textarea name="admin_note" class="m-textarea" rows="3" placeholder="Contoh: stok tidak tersedia, data tidak valid..."></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="modal-btn-cancel" onclick="closeModal('reject-{{ $b->id }}')">Batal</button>
          <button type="submit" class="modal-btn-danger">Konfirmasi Tolak</button>
        </div>
      </form>
    </div>
  </div>
  @endif

  @if($b->status==='returning')
  <div id="modal-reject-return-{{ $b->id }}" class="modal-overlay" onclick="handleOverlayClick(event,'reject-return-{{ $b->id }}')">
    <div class="modal">
      <div class="modal-header">
        <div>
          <div class="modal-title">Tolak Pengembalian</div>
          <div style="font-size:.72rem;color:var(--muted);margin-top:2px">{{ Str::limit($b->book->title, 40) }} &bull; {{ $b->user->name }}</div>
        </div>
        <button type="button" class="modal-close" onclick="closeModal('reject-return-{{ $b->id }}')">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
      </div>
      <form method="POST" action="{{ route('admin.borrowings.reject-return',$b) }}">@csrf
        <div class="modal-body">
          <div class="modal-notice notice-amber">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            Status kembali ke <strong>Dipinjam</strong>; user perlu mengajukan pengembalian ulang.
          </div>
          <div>
            <label class="m-field-label">Alasan penolakan <span style="color:var(--muted-2);font-weight:400;text-transform:none;letter-spacing:0">(opsional)</span></label>
            <textarea name="admin_note" class="m-textarea" rows="3" placeholder="Contoh: buku belum dikembalikan secara fisik..."></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="modal-btn-cancel" onclick="closeModal('reject-return-{{ $b->id }}')">Batal</button>
          <button type="submit" class="modal-btn-danger">Konfirmasi Tolak</button>
        </div>
      </form>
    </div>
  </div>
  @endif

@endforeach

@endsection
