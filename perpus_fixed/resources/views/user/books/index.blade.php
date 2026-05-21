@extends('layouts.app')
@section('title', 'Koleksi Buku')

@section('content')
<div class="container py-4">
    <div class="row g-4">
        {{-- SIDEBAR FILTER --}}
        <div class="col-md-3">
            <div class="card p-3 sticky-top" style="top:80px">
                <h6 class="fw-bold mb-3">🏷️ Filter Genre</h6>
                <a href="{{ route('user.books.index', request()->except('category')) }}"
                   class="category-pill d-block mb-2 text-center {{ !request('category') ? 'active' : '' }}">
                    Semua Genre
                </a>
                @foreach($categories as $cat)
                <a href="{{ route('user.books.index', array_merge(request()->all(), ['category' => $cat->slug])) }}"
                   class="category-pill d-block mb-2 text-center {{ request('category') === $cat->slug ? 'active' : '' }}">
                    {{ $cat->icon }} {{ $cat->name }} <small>({{ $cat->books_count }})</small>
                </a>
                @endforeach
            </div>
        </div>

        {{-- BUKU --}}
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0">
                    @if(request('search'))
                        Hasil pencarian: "{{ request('search') }}"
                    @elseif(request('category'))
                        Genre: {{ $selectedCategory }}
                    @else
                        Semua Buku
                    @endif
                    <span class="text-muted fw-normal fs-6">({{ $books->total() }} buku)</span>
                </h5>
                @if(request('search') || request('category'))
                    <a href="{{ route('user.books.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-x"></i> Reset
                    </a>
                @endif
            </div>

            <div class="row g-3">
                @forelse($books as $book)
                <div class="col-6 col-md-4">
                    <div class="book-card card h-100">
                        <a href="{{ route('user.books.show', $book) }}">
                            <img src="{{ $book->cover_url }}" class="card-img-top" alt="{{ $book->title }}" style="height:220px;object-fit:cover">
                        </a>
                        <div class="card-body p-3">
                            <span class="badge bg-light text-secondary mb-1" style="font-size:.7rem">{{ $book->category->name }}</span>
                            <h6 class="fw-bold mb-1" style="line-height:1.3">
                                <a href="{{ route('user.books.show', $book) }}" class="text-decoration-none text-dark">{{ Str::limit($book->title, 45) }}</a>
                            </h6>
                            <p class="text-muted mb-2" style="font-size:.82rem">{{ $book->author }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge {{ $book->isAvailable() ? 'bg-success' : 'bg-danger' }}" style="font-size:.7rem">
                                    {{ $book->isAvailable() ? '✓ Tersedia' : '✗ Habis' }}
                                </span>
                                <small class="text-muted">⭐ {{ number_format($book->avgRating(), 1) }}</small>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-search" style="font-size:3rem;opacity:.3"></i>
                        <p class="mt-2">Tidak ada buku ditemukan.</p>
                    </div>
                </div>
                @endforelse
            </div>

            <div class="mt-4">{{ $books->withQueryString()->links() }}</div>
        </div>
    </div>
</div>
@endsection
