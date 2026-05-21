@extends('layouts.admin')
@section('title','Kelola Kategori')
@section('page-title','Kategori')
@section('page-subtitle','Kelola kategori koleksi buku')

@section('content')
{{--
  CATATAN ARSITEKTUR:
  Manajemen kategori sudah terintegrasi di admin/books/index (tab "Kelola Kategori").
  Halaman ini sebelumnya menampilkan UI duplikat dengan desain berbeda.
  Sekarang diarahkan ke halaman terpadu untuk konsistensi.
--}}

<div style="display:flex;flex-direction:column;align-items:center;justify-content:center;min-height:40vh;text-align:center;gap:18px">
  <div style="width:64px;height:64px;border-radius:16px;background:var(--green-pale);display:flex;align-items:center;justify-content:center">
    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M4 20h4l10.5-10.5a2.121 2.121 0 0 0-3-3L5 17v3"/><line x1="13.5" y1="6.5" x2="17.5" y2="10.5"/></svg>
  </div>
  <div>
    <div style="font-family:'Syne',sans-serif;font-weight:700;font-size:1rem;margin-bottom:6px">Kelola Kategori</div>
    <div style="font-size:.83rem;color:var(--muted);max-width:340px;line-height:1.6">
      Manajemen kategori sudah tersedia di halaman <strong>Manajemen Buku</strong>, tab <em>Kelola Kategori</em>.
    </div>
  </div>
  <a href="{{ route('admin.books.index', ['tab' => 'categories']) }}" class="btn-primary" style="text-decoration:none">
    Buka Manajemen Kategori →
  </a>
</div>
@endsection
