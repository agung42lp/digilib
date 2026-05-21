@extends('layouts.admin')
@section('title','Edit Buku')
@section('page-title','Edit Buku')
@section('page-subtitle','Perbarui data koleksi · ' . $book->title)
@section('back-url',route('admin.books.index'))

@section('content')
<div class="form-page">
  <div class="form-card">
    <div class="form-card-header">
      <div class="form-card-title">Edit Informasi Buku</div>
      <div class="form-card-sub">ID: BK-{{ str_pad($book->id,3,'0',STR_PAD_LEFT) }} · Ditambahkan {{ $book->created_at->format('d M Y') }}</div>
    </div>
    <form method="POST" action="{{ route('admin.books.update',$book) }}" enctype="multipart/form-data">
      @csrf @method('PUT')
      <div class="form-body">
        <div class="cover-preview-wrap">
          <div class="cover-preview" id="cover-preview-box" style="{{ $book->cover ? 'background-image:url('.Storage::url($book->cover).');background-size:cover;background-position:center' : '' }}">
            @if(!$book->cover)
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.6)" stroke-width="1.75"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
            @endif
          </div>
          <div>
            <div style="font-size:.82rem;font-weight:600;margin-bottom:2px">{{ $book->title }}</div>
            <div style="font-size:.7rem;color:var(--muted-2);margin-bottom:8px">{{ $book->cover ? 'Cover terpasang · Klik untuk ganti' : 'Belum ada cover' }}</div>
            <label class="btn-secondary" style="font-size:.6rem;padding:6px 12px;cursor:pointer">
              Ganti Cover
              <input type="file" name="cover" accept="image/*" style="display:none" onchange="previewCover(this)">
            </label>
          </div>
        </div>

        <div class="form-row cols-3">
          <div><label class="field-label">Judul Buku <span>*</span></label><input class="form-input" name="title" value="{{ old('title',$book->title) }}" required/></div>
          <div><label class="field-label">Stok <span>*</span></label><input class="form-input" name="stock" type="number" min="0" value="{{ old('stock',$book->stock) }}" required/></div>
          <div><label class="field-label">Tahun Terbit</label><input class="form-input" name="published_year" type="number" value="{{ old('published_year',$book->published_year) }}"/></div>
        </div>

        <div class="form-row cols-2">
          <div><label class="field-label">Penulis <span>*</span></label><input class="form-input" name="author" value="{{ old('author',$book->author) }}" required/></div>
          <div><label class="field-label">Penerbit</label><input class="form-input" name="publisher" value="{{ old('publisher',$book->publisher) }}"/></div>
        </div>

        <div class="form-row cols-2">
          <div><label class="field-label">Kategori <span>*</span></label>
            <select class="form-select" name="category_id" required>
              <option value="">— Pilih Kategori —</option>
              @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ (old('category_id',$book->category_id)==$cat->id)?'selected':'' }}>{{ $cat->name }}</option>
              @endforeach
            </select>
          </div>
          <div><label class="field-label">ISBN</label><input class="form-input" name="isbn" value="{{ old('isbn',$book->isbn) }}"/></div>
        </div>

        <div class="form-row cols-1">
          <div><label class="field-label">Deskripsi</label><textarea class="form-textarea" name="description" rows="3">{{ old('description',$book->description) }}</textarea></div>
        </div>

        @if($book->activeBorrowings()->count() > 0)
        <div class="notice-blue modal-notice" style="border-radius:8px">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;margin-top:1px"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
          <span>Buku ini sedang dipinjam oleh {{ $book->activeBorrowings()->count() }} anggota. Perubahan stok berlaku setelah buku dikembalikan.</span>
        </div>
        @endif
      </div>

      <div class="form-footer">
        <button type="submit" class="btn-primary">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
          Simpan Perubahan
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
