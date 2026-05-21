@extends('layouts.admin')
@section('title','Generate Laporan')
@section('page-title','Laporan')
@section('page-subtitle','Generate & unduh laporan perpustakaan')

@push('styles')
<style>
.report-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:16px}
.report-card{background:var(--white);border:1px solid var(--border);border-radius:14px;padding:24px;display:flex;flex-direction:column;align-items:flex-start;gap:14px;transition:all .2s}
.report-card:hover{border-color:var(--border-2);box-shadow:0 4px 20px rgba(0,0,0,.07);transform:translateY(-1px)}
.report-icon{width:48px;height:48px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.3rem;flex-shrink:0}
.report-name{font-size:.9rem;font-weight:600;color:var(--ink);margin-bottom:4px}
.report-desc{font-size:.75rem;color:var(--muted)}
</style>
@endpush

@section('content')
@php $isAdmin = auth()->user()->isAdmin(); @endphp

<div class="report-grid">
  {{-- Buku --}}
  <div class="report-card">
    <div class="report-icon" style="background:var(--green-pale);color:var(--green)">📚</div>
    <div>
      <div class="report-name">Laporan Buku</div>
      <div class="report-desc">Data seluruh koleksi buku perpustakaan. Filter per kategori, export ke CSV atau cetak PDF.</div>
    </div>
    <div style="display:flex;gap:8px;margin-top:auto;flex-wrap:wrap">
      <a href="{{ route('admin.reports.books') }}" class="btn-secondary" style="height:32px;font-size:.65rem">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg> Lihat
      </a>
      <a href="{{ route('admin.reports.books', ['format'=>'csv']) }}" class="btn-secondary" style="height:32px;font-size:.65rem">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg> CSV
      </a>
      <a href="{{ route('admin.reports.books', ['format'=>'pdf']) }}" class="btn-danger" style="height:32px;font-size:.65rem">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg> PDF
      </a>
    </div>
  </div>

  {{-- Peminjaman --}}
  <div class="report-card">
    <div class="report-icon" style="background:var(--blue-pale);color:var(--blue)">🔄</div>
    <div>
      <div class="report-name">Laporan Peminjaman</div>
      <div class="report-desc">Rekap data peminjaman dan pengembalian. Filter per status dan rentang tanggal.</div>
    </div>
    <div style="display:flex;gap:8px;margin-top:auto;flex-wrap:wrap">
      <a href="{{ route('admin.reports.borrowings') }}" class="btn-secondary" style="height:32px;font-size:.65rem">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg> Lihat
      </a>
      <a href="{{ route('admin.reports.borrowings', ['format'=>'csv']) }}" class="btn-secondary" style="height:32px;font-size:.65rem">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg> CSV
      </a>
      <a href="{{ route('admin.reports.borrowings', ['format'=>'pdf']) }}" class="btn-danger" style="height:32px;font-size:.65rem">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg> PDF
      </a>
    </div>
  </div>

  @if($isAdmin)
  {{-- User/Anggota — admin only --}}
  <div class="report-card">
    <div class="report-icon" style="background:var(--amber-pale);color:var(--amber)">👥</div>
    <div>
      <div class="report-name">Laporan Anggota</div>
      <div class="report-desc">Data seluruh anggota perpustakaan beserta statistik peminjaman masing-masing.</div>
    </div>
    <div style="display:flex;gap:8px;margin-top:auto;flex-wrap:wrap">
      <a href="{{ route('admin.reports.users') }}" class="btn-secondary" style="height:32px;font-size:.65rem">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg> Lihat
      </a>
      <a href="{{ route('admin.reports.users', ['format'=>'csv']) }}" class="btn-secondary" style="height:32px;font-size:.65rem">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg> CSV
      </a>
      <a href="{{ route('admin.reports.users', ['format'=>'pdf']) }}" class="btn-danger" style="height:32px;font-size:.65rem">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg> PDF
      </a>
    </div>
  </div>

  {{-- Petugas — admin only --}}
  <div class="report-card">
    <div class="report-icon" style="background:rgba(93,185,138,.12);color:#2e7d57">🧑‍💼</div>
    <div>
      <div class="report-name">Laporan Petugas</div>
      <div class="report-desc">Data seluruh petugas dan admin perpustakaan beserta aktivitas usulan buku yang diproses.</div>
    </div>
    <div style="display:flex;gap:8px;margin-top:auto;flex-wrap:wrap">
      <a href="{{ route('admin.reports.staff') }}" class="btn-secondary" style="height:32px;font-size:.65rem">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg> Lihat
      </a>
      <a href="{{ route('admin.reports.staff', ['format'=>'csv']) }}" class="btn-secondary" style="height:32px;font-size:.65rem">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg> CSV
      </a>
      <a href="{{ route('admin.reports.staff', ['format'=>'pdf']) }}" class="btn-danger" style="height:32px;font-size:.65rem">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg> PDF
      </a>
    </div>
  </div>
  @endif
</div>
@endsection
