@extends('layouts.admin')
@section('title','Detail Buku')
@section('page-title','Detail Buku')

@section('content')
<div style="margin-bottom:16px;display:flex;align-items:center;gap:10px">
  <a href="{{ route('admin.books.index') }}" class="btn-secondary">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>Kembali
  </a>
  <div style="flex:1"></div>
  <a href="{{ route('admin.books.edit', $book) }}" class="btn-primary">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>Edit Buku
  </a>
</div>

<div class="row g-4">
  {{-- Cover --}}
  <div class="col-md-3">
    <div class="stat-card" style="text-align:center">
      @if($book->cover)
        <img src="{{ $book->cover_url }}" style="width:100%;max-width:180px;border-radius:8px;box-shadow:0 4px 20px rgba(0,0,0,.12)" alt="">
      @else
        <div style="width:100%;height:200px;background:var(--surface);border-radius:8px;display:flex;align-items:center;justify-content:center;color:var(--muted-2);font-size:.8rem">Tanpa cover</div>
      @endif
      <div style="margin-top:16px">
        <span class="badge  {{ $book->isAvailable() ? 'badge-green' : 'badge-red' }}" style="font-size:.65rem;padding:4px 12px">
          {{ $book->isAvailable() ? 'Tersedia' : 'Tidak Tersedia' }}
        </span>
        <div style="margin-top:10px;font-size:.75rem;color:var(--muted)">Stok: <strong style="color:var(--ink)">{{ $book->stock }}</strong></div>
        <div style="font-size:.75rem;color:var(--muted)">Dipinjam: <strong style="color:var(--ink)">{{ $book->borrowed_count }}×</strong></div>
        <div style="font-size:.75rem;color:var(--muted)">Rating: <strong style="color:var(--amber)">⭐ {{ number_format($book->avgRating(),1) }}</strong></div>
      </div>
    </div>
  </div>

  {{-- Detail --}}
  <div class="col-md-9">
    <div class="stat-card" style="margin-bottom:16px">
      <h4 style="font-family:'Instrument Serif',serif;font-size:1.5rem;color:var(--ink);letter-spacing:-.03em;margin-bottom:4px">{{ $book->title }}</h4>
      <p style="color:var(--muted);font-size:.85rem;margin-bottom:20px">{{ $book->author }} — {{ $book->publisher }}</p>

      <div class="row g-3">
        @php
          $fields = [
            'Kategori' => $book->category->name ?? '-',
            'ISBN' => $book->isbn ?? '-',
            'Tanggal Terbit' => $book->publish_date?->format('d M Y') ?? '-',
            'Bahasa' => $book->language ?? '-',
            'Halaman' => $book->pages ? $book->pages.' hal' : '-',
            'Dimensi' => ($book->width && $book->height) ? $book->width.'×'.$book->height.' cm' : '-',
            'Berat' => $book->weight ? $book->weight.' gram' : '-',
            'Ulasan' => $book->reviews->count().' ulasan',
          ];
        @endphp
        @foreach($fields as $label => $value)
        <div class="col-sm-6 col-md-3">
          <div style="font-family:'Syne',sans-serif;font-size:.6rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--muted-2);margin-bottom:4px">{{ $label }}</div>
          <div style="font-size:.82rem;font-weight:500;color:var(--ink)">{{ $value }}</div>
        </div>
        @endforeach
      </div>

      @if($book->synopsis)
        <div style="margin-top:20px;padding-top:16px;border-top:1px solid var(--border)">
          <div style="font-family:'Syne',sans-serif;font-size:.62rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--muted-2);margin-bottom:8px">Sinopsis</div>
          <p style="font-size:.85rem;color:var(--ink-2);line-height:1.65">{{ $book->synopsis }}</p>
        </div>
      @endif
    </div>

    {{-- Riwayat Peminjaman --}}
    <div class="card" style="margin-bottom:16px">
      <div style="padding:16px 20px;border-bottom:1px solid var(--border)">
        <div style="font-family:'Syne',sans-serif;font-size:.72rem;font-weight:700;color:var(--ink)">Riwayat Peminjaman ({{ $book->borrowings->count() }})</div>
      </div>
      @if($book->borrowings->isEmpty())
        <div style="padding:24px;text-align:center;color:var(--muted-2);font-size:.82rem">Belum ada riwayat peminjaman.</div>
      @else
        <div class="data-table-wrap" style="border:none;border-radius:0 0 12px 12px">
          <table>
            <thead><tr><th>Peminjam</th><th>Tgl Pinjam</th><th>Tgl Kembali</th><th>Status</th></tr></thead>
            <tbody>
              @foreach($book->borrowings->take(10) as $b)
              <tr>
                <td>{{ $b->user->name }}</td>
                <td style="font-size:.75rem;color:var(--muted)">{{ $b->borrow_date->format('d/m/Y') }}</td>
                <td style="font-size:.75rem;color:var(--muted)">{{ $b->return_date->format('d/m/Y') }}</td>
                <td>
                  @php $bm=['pending'=>'badge-amber','approved'=>'badge-blue','returning'=>'badge-amber','returned'=>'badge-muted','rejected'=>'badge-red']; @endphp
                  <span class="badge  {{ $bm[$b->status]??'badge-muted' }}">{{ $b->status_label }}</span>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif
    </div>

    {{-- Ulasan --}}
    <div class="card">
      <div style="padding:16px 20px;border-bottom:1px solid var(--border)">
        <div style="font-family:'Syne',sans-serif;font-size:.72rem;font-weight:700;color:var(--ink)">Ulasan Pembaca ({{ $book->reviews->count() }})</div>
      </div>
      <div style="padding:16px 20px">
        @forelse($book->reviews->take(5) as $r)
          <div style="padding:12px 0;border-bottom:1px solid var(--border)">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:4px">
              <div style="font-size:.8rem;font-weight:600;color:var(--ink)">{{ $r->user->name }}</div>
              <div style="font-size:.75rem;color:var(--amber)">{{ str_repeat('★',$r->rating) }}{{ str_repeat('☆',5-$r->rating) }}</div>
            </div>
            <p style="font-size:.78rem;color:var(--muted);margin:0">{{ $r->comment ?? 'Tidak ada komentar.' }}</p>
          </div>
        @empty
          <div style="text-align:center;color:var(--muted-2);font-size:.82rem;padding:16px 0">Belum ada ulasan.</div>
        @endforelse
      </div>
    </div>
  </div>
</div>
@endsection
