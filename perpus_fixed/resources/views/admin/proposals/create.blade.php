@extends('layouts.admin')
@section('title','Usulkan Buku')
@section('page-title','Ajukan Usulan Buku')
@section('page-subtitle','Isi form berikut dan kirim untuk direview admin')
@section('back-url',route('admin.books.proposals.index'))

@section('content')
<div class="form-page">
  <div class="notice-blue modal-notice" style="border-radius:10px;margin-bottom:4px">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;margin-top:1px"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
    <div style="font-size:.78rem;line-height:1.55">
      <strong>Usulan ini akan dikirim ke Admin untuk direview.</strong><br/>
      Buku baru ditambahkan ke koleksi hanya setelah disetujui. Kamu akan mendapat notifikasi hasilnya.
    </div>
  </div>

  <div class="form-card">
    <div class="form-card-header">
      <div class="form-card-title">Informasi Buku yang Diusulkan</div>
      <div class="form-card-sub">Isi data buku selengkap mungkin untuk memudahkan review</div>
    </div>
    <form method="POST" action="{{ route('admin.books.proposals.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="form-body">
        <div class="cover-preview-wrap">
          <div class="cover-preview" id="cover-preview-box">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.4)" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
          </div>
          <div>
            <div style="font-size:.82rem;font-weight:500;margin-bottom:4px">Cover Buku</div>
            <div style="font-size:.72rem;color:var(--muted-2);margin-bottom:8px">JPG/PNG, maks. 2MB (opsional)</div>
            <label class="btn-secondary" style="font-size:.6rem;padding:6px 12px;cursor:pointer">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
              Upload Cover
              <input type="file" name="cover" accept="image/*" style="display:none" onchange="previewCover(this)">
            </label>
          </div>
        </div>

        <div class="form-row cols-2">
          <div><label class="field-label">Judul Buku <span>*</span></label><input class="form-input" name="title" value="{{ old('title') }}" placeholder="Masukkan judul lengkap buku" required/></div>
          <div><label class="field-label">Tahun Terbit</label><input class="form-input" name="published_year" type="number" placeholder="{{ date('Y') }}" value="{{ old('published_year') }}"/></div>
        </div>

        <div class="form-row cols-2">
          <div><label class="field-label">Penulis <span>*</span></label><input class="form-input" name="author" value="{{ old('author') }}" placeholder="Nama penulis" required/></div>
          <div><label class="field-label">Penerbit</label><input class="form-input" name="publisher" value="{{ old('publisher') }}" placeholder="Nama penerbit"/></div>
        </div>

        <div class="form-row cols-2">
          <div>
            <label class="field-label">Kategori <span>*</span></label>
            <select class="form-select" name="category_id" required>
              <option value="">— Pilih Kategori —</option>
              @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_id')==$cat->id?'selected':'' }}>{{ $cat->name }}</option>
              @endforeach
            </select>
          </div>
          <div>
            <label class="field-label">ISBN</label>
            <input class="form-input" name="isbn" value="{{ old('isbn') }}" placeholder="978-xxx-xxx-xxx-x"/>
            <div class="form-hint">Opsional, membantu verifikasi duplikat</div>
          </div>
        </div>

        <div class="form-row cols-1">
          <div><label class="field-label">Deskripsi / Sinopsis</label><textarea class="form-textarea" name="description" rows="3" placeholder="Gambaran singkat isi buku...">{{ old('description') }}</textarea></div>
        </div>

        <div class="form-row cols-1">
          <div>
            <label class="field-label">Alasan Pengajuan <span>*</span></label>
            <textarea class="form-textarea" name="reason" rows="2" placeholder="Mengapa buku ini perlu ditambahkan? cth. Banyak diminta pengunjung, mendukung kurikulum..." required>{{ old('reason') }}</textarea>
            <div class="form-hint">Alasan yang jelas membantu admin mengambil keputusan lebih cepat.</div>
          </div>
        </div>
      </div>

      <div class="form-footer">
        <button type="submit" class="btn-primary">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
          Kirim Usulan ke Admin
        </button>
        <a href="{{ route('admin.books.proposals.index') }}" class="btn-secondary">Batal</a>
      </div>
    </form>
  </div>
</div>
@endsection

@push('scripts')
<script>
function previewCover(input){
  if(input.files&&input.files[0]){
    const r=new FileReader();
    r.onload=e=>{
      const b=document.getElementById('cover-preview-box');
      b.style.cssText='background-image:url('+e.target.result+');background-size:cover;background-position:center';
      b.innerHTML='';
    };
    r.readAsDataURL(input.files[0]);
  }
}
</script>
@endpush
