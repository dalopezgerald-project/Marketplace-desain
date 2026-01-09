<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>@yield('title', 'DesignHub - Marketplace Jasa Desain')</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

@vite(['resources/css/app.css', 'resources/js/app.js'])

<style>
:root {
    --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    --accent-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    --success-gradient: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    --warning-gradient: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
}

body {
    font-family: 'Inter', sans-serif;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: 100vh;
    margin: 0;
}

.navbar-modern {
    background: rgba(255,255,255,0.95);
    backdrop-filter: blur(10px);
    box-shadow: 0 2px 20px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    padding: 1rem 0;
}

.navbar-brand-modern {
    font-weight: 700;
    font-size: 1.5rem;
    background: var(--primary-gradient);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.navbar-nav .nav-link {
    font-weight: 500;
    color: #6c757d !important;
    transition: color 0.3s ease;
}

.navbar-nav .nav-link:hover {
    color: #667eea !important;
}

.user-info {
    background: var(--accent-gradient);
    color: white;
    padding: 8px 16px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.9rem;
}

.btn-modern {
    border: none;
    border-radius: 50px;
    padding: 8px 20px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.btn-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
}

.btn-logout {
    background: var(--secondary-gradient);
    color: white;
}

.main-content {
    padding: 2rem 0;
    min-height: calc(100vh - 200px);
}

.card-modern {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    border: 1px solid rgba(0,0,0,0.05);
    overflow: hidden;
}

.card-modern:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.footer-modern {
    background: var(--primary-gradient);
    color: white;
    padding: 3rem 0 1rem;
    margin-top: 4rem;
}

.footer-modern h5 {
    color: white;
    margin-bottom: 1.5rem;
    font-weight: 600;
}

.footer-modern .list-unstyled li {
    margin-bottom: 0.5rem;
}

.footer-modern .list-unstyled a {
    color: rgba(255,255,255,0.8);
    text-decoration: none;
    transition: color 0.3s ease;
}

.footer-modern .list-unstyled a:hover {
    color: white;
}

.footer-bottom {
    border-top: 1px solid rgba(255,255,255,0.1);
    padding-top: 1rem;
    margin-top: 2rem;
    text-align: center;
    color: rgba(255,255,255,0.7);
}

.animate-fade-in {
    animation: fadeIn 0.6s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

@media (max-width: 768px) {
    .navbar-brand-modern {
        font-size: 1.2rem;
    }
    .user-info {
        font-size: 0.8rem;
        padding: 6px 12px;
    }
}
</style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light navbar-modern">
<div class="container">
    <a class="navbar-brand navbar-brand-modern" href="{{ url('/') }}">
        <i class="fas fa-palette me-2"></i>DesignHub
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}">Beranda</a>
            </li>
            @auth
    @if(auth()->user()->role === 'admin')
        <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
    @elseif(auth()->user()->role === 'desainer')
        <a class="nav-link" href="{{ route('desainer.services.index') }}">Dashboard</a>
    @else
        <a class="nav-link" href="{{ route('user.services') }}">Dashboard</a>
    @endif
@endauth

        </ul>

        <ul class="navbar-nav">
            @auth

            {{-- ADMIN --}}
    @if(auth()->user()->role === 'admin')
        <li class="nav-item">
            <a class="nav-link" href="/admin/dashboard">Admin Dashboard</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('messages.index') }}">
                <i class="fas fa-comments me-1"></i>Pesan
            </a>
        </li>
    @endif

    {{-- DESAINER --}}
    @if(auth()->user()->role === 'desainer')
        <li class="nav-item">
            <a class="nav-link" href="/desainer/services">Jasa Saya</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/desainer/services/create">Tambah Jasa</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('messages.index') }}">
                <i class="fas fa-comments me-1"></i>Pesan
            </a>
        </li>
    @endif

    {{-- USER --}}
    @if(auth()->user()->role === 'user')
        <li class="nav-item">
            <a class="nav-link" href="/services">Jelajah Jasa</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('user.order-history') }}">
                <i class="fas fa-shopping-cart me-1"></i>Pesanan Saya
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('messages.index') }}">
                <i class="fas fa-comments me-1"></i>Pesan
            </a>
        </li>
    @endif

            <li class="nav-item me-3">
                <span class="user-info">
                    <i class="fas fa-user-circle me-1"></i>
                    {{ auth()->user()->name }} ({{ ucfirst(auth()->user()->role) }})
                </span>
            </li>
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-modern btn-logout">
                        <i class="fas fa-sign-out-alt me-1"></i>Logout
                    </button>
                </form>
            </li>
            @else
            <li class="nav-item">
                <a href="{{ route('login') }}" class="btn btn-modern btn-secondary-modern me-2">
                    <i class="fas fa-sign-in-alt me-1"></i>Masuk
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('register') }}" class="btn btn-modern btn-primary-modern">
                    <i class="fas fa-user-plus me-1"></i>Daftar
                </a>
            </li>
            @endauth
        </ul>
    </div>
</div>
</nav>

<main class="main-content animate-fade-in">
<div class="container">
    @yield('content')
</div>
</main>

<footer class="footer-modern">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5><i class="fas fa-palette me-2"></i>DesignHub</h5>
                <p>Platform marketplace terdepan untuk jasa desain grafis. Hubungkan kreativitas Anda dengan klien yang tepat.</p>
            </div>
            <div class="col-md-2">
                <h5>Platform</h5>
                <ul class="list-unstyled">
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="#">Cara Kerja</a></li>
                    <li><a href="#">Keamanan</a></li>
                    <li><a href="#">Dukungan</a></li>
                </ul>
            </div>
            <div class="col-md-2">
                <h5>Kategori</h5>
                <ul class="list-unstyled">
                    <li><a href="#">Logo Design</a></li>
                    <li><a href="#">Web Design</a></li>
                    <li><a href="#">UI/UX Design</a></li>
                    <li><a href="#">Print Design</a></li>
                </ul>
            </div>
            <div class="col-md-2">
                <h5>Bantuan</h5>
                <ul class="list-unstyled">
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Kontak</a></li>
                    <li><a href="#">Syarat & Ketentuan</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="col-md-2">
                <h5>Ikuti Kami</h5>
                <div class="d-flex">
                    <a href="#" class="text-white me-3"><i class="fab fa-facebook-f fa-lg"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-twitter fa-lg"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-instagram fa-lg"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-linkedin-in fa-lg"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <p>&copy; 2024 DesignHub. All rights reserved. Made with <i class="fas fa-heart text-danger"></i> for designers.</p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
