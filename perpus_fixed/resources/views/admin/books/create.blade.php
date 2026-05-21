@extends('layouts.admin')
@section('title','Tambah Buku')
@section('page-title','Tambah Buku')
@section('page-subtitle','Tambahkan koleksi baru ke perpustakaan')
@section('back-url',route('admin.books.index'))

@section('content')
<div class="form-page">
  <div class="form-card">
    <div class="form-card-header">
      <div class="form-card-title">Informasi Buku</div>
      <div class="form-card-sub">Isi seluruh data buku dengan lengkap</div>
    </div>
    <form method="POST" action="{{ route('admin.books.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="form-body">
        {{-- Cover preview --}}
        <div class="cover-preview-wrap">
          <div class="cover-preview" id="cover-preview-box">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.4)" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
          </div>
          <div>
            <div style="font-size:.82rem;font-weight:500;margin-bottom:4px">Cover Buku</div>
            <div style="font-size:.72rem;color:var(--muted-2);margin-bottom:8px">JPG/PNG, maks. 2MB</div>
            <label class="btn-secondary" style="font-size:.6rem;padding:6px 12px;cursor:pointer">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
              Upload Cover
              <input type="file" name="cover" accept="image/*" style="display:none" onchange="previewCover(this)">
            </label>
          </div>
        </div>

        <div class="form-row cols-3">
          <div>
            <label class="field-label">Judul Buku <span>*</span></label>
            <input class="form-input" name="title" value="{{ old('title') }}" placeholder="Masukkan judul lengkap" required/>
          </div>
          <div>
            <label class="field-label">Stok <span>*</span></label>
            <input class="form-input" name="stock" type="number" min="0" value="{{ old('stock',1) }}" required/>
          </div>
          <div>
            <label class="field-label">Tahun Terbit</label>
            <input class="form-input" name="published_year" type="number" min="1900" max="{{ date('Y') }}" value="{{ old('published_year') }}" placeholder="{{ date('Y') }}"/>
          </div>
        </div>

        <div class="form-row cols-2">
          <div>
            <label class="field-label">Penulis <span>*</span></label>
            <input class="form-input" name="author" value="{{ old('author') }}" placeholder="Nama penulis" required/>
          </div>
          <div>
            <label class="field-label">Penerbit</label>
            <input class="form-input" name="publisher" value="{{ old('publisher') }}" placeholder="Nama penerbit"/>
          </div>
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
          </div>
        </div>

        <div class="form-row cols-1">
          <div>
            <label class="field-label">Deskripsi / Sinopsis</label>
            <textarea class="form-textarea" name="description" rows="3" placeholder="Sinopsis atau deskripsi singkat buku...">{{ old('description') }}</textarea>
          </div>
        </div>
      </div>

      <div class="form-footer">
        <button type="submit" class="btn-primary">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
          Simpan Buku
        </button>
        <a href="{{ route('admin.books.index') }}" class="btn-secondary">Batal</a>
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
      const box=document.getElementById('cover-preview-box');
      box.style.backgroundImage='url('+e.target.result+')';
      box.style.backgroundSize='cover';
      box.style.backgroundPosition='center';
      box.innerHTML='';
    };
    r.readAsDataURL(input.files[0]);
  }
}
</script>
@endpush
