<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Perpustakaan Digital')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root { --primary: #1a56db; --dark: #1e3a5f; }
        body { font-family: 'Segoe UI', sans-serif; background: #f8fafc; }
        .navbar { background: linear-gradient(135deg, #1e3a5f, #1a56db); }
        .navbar-brand { font-weight: 700; font-size: 1.3rem; }
        .nav-link { color: rgba(255,255,255,.85) !important; }
        .nav-link:hover, .nav-link.active { color: #fff !important; }
        .search-bar input { border-radius: 25px 0 0 25px; border: none; }
        .search-bar button { border-radius: 0 25px 25px 0; }
        .book-card { border: none; border-radius: 12px; overflow: hidden; transition: .3s; box-shadow: 0 2px 8px rgba(0,0,0,.08); }
        .book-card:hover { transform: translateY(-4px); box-shadow: 0 8px 25px rgba(0,0,0,.15); }
        .book-card img { height: 220px; object-fit: cover; }
        .category-pill { border-radius: 20px; padding: 6px 16px; border: 2px solid #e2e8f0; transition: .2s; cursor: pointer; text-decoration: none; color: #374151; }
        .category-pill:hover, .category-pill.active { background: var(--primary); color: #fff; border-color: var(--primary); }
        .hero { background: linear-gradient(135deg, #1e3a5f 0%, #1a56db 100%); color: #fff; padding: 60px 0; }
        footer { background: #1e3a5f; color: rgba(255,255,255,.7); padding: 40px 0 20px; }
        .badge-stock-ok { background: #dcfce7; color: #15803d; }
        .badge-stock-no { background: #fee2e2; color: #dc2626; }
    </style>
    @stack('styles')
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('user.dashboard') }}">📚 Perpustakaan</a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navMenu"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navMenu">
            <form class="d-flex mx-auto search-bar" action="{{ route('user.books.index') }}" method="GET" style="width:360px">
                <input class="form-control" type="search" name="search" placeholder="Cari buku, penulis..." value="{{ request('search') }}">
                <button class="btn btn-warning" type="submit"><i class="bi bi-search"></i></button>
            </form>
            <ul class="navbar-nav ms-auto gap-1 align-items-center">
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('user.dashboard') ? 'active fw-semibold' : '' }}" href="{{ route('user.dashboard') }}"><i class="bi bi-house"></i> Beranda</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('user.books.*') ? 'active fw-semibold' : '' }}" href="{{ route('user.books.index') }}"><i class="bi bi-book"></i> Buku</a></li>
                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">
                        <i class="bi bi-person-circle"></i> {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('user.profile') }}"><i class="bi bi-person me-2"></i>Profil Saya</a></li>
                        @if(auth()->user()->isPetugas())
                        <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="bi bi-shield me-2"></i>Panel Admin</a></li>
                        @endif
                        <li><hr class="dropdown-divider"></li>
                        <li><form method="POST" action="{{ route('logout') }}">@csrf<button class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i>Logout</button></form></li>
                    </ul>
                </li>
                @else
                <li class="nav-item"><a class="btn btn-outline-light btn-sm" href="{{ route('login') }}">Masuk</a></li>
                <li class="nav-item"><a class="btn btn-warning btn-sm" href="{{ route('register') }}">Daftar</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show m-0 rounded-0 text-center">
    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif
@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show m-0 rounded-0 text-center">
    <i class="bi bi-x-circle me-2"></i>{{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif
@if(session('info'))
<div class="alert alert-info alert-dismissible fade show m-0 rounded-0 text-center">
    <i class="bi bi-info-circle me-2"></i>{{ session('info') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@yield('content')

<footer>
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <h5 class="text-white mb-2">📚 Perpustakaan Digital</h5>
                <p class="mb-0" style="font-size:.9rem">Perpustakaan digital untuk kebutuhan literasi masyarakat.</p>
            </div>
            <div class="col-md-4">
                <h6 class="text-white">Navigasi</h6>
                <ul class="list-unstyled">
                    <li><a href="{{ route('user.dashboard') }}" class="text-decoration-none" style="color:rgba(255,255,255,.6)">Beranda</a></li>
                    <li><a href="{{ route('user.books.index') }}" class="text-decoration-none" style="color:rgba(255,255,255,.6)">Koleksi Buku</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h6 class="text-white">Kontak</h6>
                <p style="font-size:.85rem">📍 Jl. Perpustakaan No.1<br>📞 (021) 123-4567<br>✉️ info@perpus.com</p>
            </div>
        </div>
        <hr style="border-color:rgba(255,255,255,.1)">
        <p class="text-center mb-0" style="font-size:.8rem">© {{ date('Y') }} Perpustakaan Digital. All rights reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
