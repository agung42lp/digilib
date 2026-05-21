@extends('layouts.admin')
@section('title','Kelola Ulasan')
@section('page-title','Ulasan')
@section('page-subtitle','Moderasi ulasan dan rating buku')

@section('content')
<div class="table-wrap">
  <table>
    <thead>
      <tr><th>User</th><th>Buku</th><th>Rating</th><th>Komentar</th><th>Tanggal</th><th>Aksi</th></tr>
    </thead>
    <tbody>
      @forelse($reviews as $r)
      <tr>
        <td>{{ $r->user->name }}</td>
        <td style="font-size:.78rem">{{ Str::limit($r->book->title,28) }}</td>
        <td>
          <div style="display:flex;align-items:center;gap:4px">
            <span style="color:var(--amber);font-size:.85rem">{{ str_repeat('★',$r->rating) }}{{ str_repeat('☆',5-$r->rating) }}</span>
            <span style="font-size:.68rem;color:var(--muted-2)">({{ $r->rating }})</span>
          </div>
        </td>
        <td style="font-size:.78rem;color:var(--muted)">{{ Str::limit($r->comment ?? '—',55) }}</td>
        <td style="font-size:.72rem;color:var(--muted-2)">{{ $r->created_at->format('d/m/Y') }}</td>
        <td>
          <form method="POST" action="{{ route('admin.reviews.destroy', $r) }}" onsubmit="return confirm('Hapus ulasan ini?')">
            @csrf @method('DELETE')
            <button type="submit" class="action-btn danger" title="Hapus">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
            </button>
          </form>
        </td>
      </tr>
      @empty
      <tr><td colspan="6" style="text-align:center;padding:48px 0;color:var(--muted-2);font-size:.82rem">Belum ada ulasan.</td></tr>
      @endforelse
    </tbody>
  </table>
  <div class="pagination">
    <span class="pag-info">{{ $reviews->total() }} ulasan</span>
    <div class="pag-btns">
      @if($reviews->onFirstPage())<span class="pag-btn disabled">‹</span>@else<a href="{{ $reviews->previousPageUrl() }}" class="pag-btn">‹</a>@endif
      @foreach($reviews->getUrlRange(max(1,$reviews->currentPage()-2),min($reviews->lastPage(),$reviews->currentPage()+2)) as $page => $url)
        <a href="{{ $url }}" class="pag-btn {{ $page==$reviews->currentPage()?'active':'' }}">{{ $page }}</a>
      @endforeach
      @if($reviews->hasMorePages())<a href="{{ $reviews->nextPageUrl() }}" class="pag-btn">›</a>@else<span class="pag-btn disabled">›</span>@endif
    </div>
  </div>
</div>
@endsection
