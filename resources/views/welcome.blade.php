<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Marketplace Jasa Desain Grafis</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --accent-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        .hero-section {
            background: var(--primary-gradient);
            color: white;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="1000" height="1000" fill="url(%23grain)"/></svg>');
            opacity: 0.1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .hero-subtitle {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .btn-modern {
            border: none;
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.3);
        }

        .btn-primary-modern {
            background: var(--secondary-gradient);
        }

        .btn-secondary-modern {
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.3);
        }

        .features-section {
            padding: 80px 0;
            background: white;
        }

        .feature-card {
            background: white;
            border-radius: 20px;
            padding: 40px 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border: 1px solid rgba(0,0,0,0.05);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: var(--accent-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 2rem;
        }

        .navbar-modern {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .navbar-brand-modern {
            font-weight: 700;
            font-size: 1.5rem;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            .hero-section {
                padding: 60px 0;
            }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light navbar-modern fixed-top">
    <div class="container">
        <a class="navbar-brand navbar-brand-modern" href="#">
            <i class="fas fa-palette me-2"></i>DesignHub
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#features">Fitur</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">Tentang</a>
                </li>
                <li class="nav-item">
                    <a href="/login" class="btn btn-modern btn-secondary-modern ms-3">Masuk</a>
                </li>
                <li class="nav-item">
                    <a href="/register" class="btn btn-modern btn-primary-modern ms-2">Daftar</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 hero-content">
                <h1 class="hero-title">
                    Temukan Desainer <br>
                    <span style="background: var(--secondary-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Profesional</span> <br>
                    Impian Anda
                </h1>
                <p class="hero-subtitle">
                    Platform marketplace terdepan untuk jasa desain grafis. Hubungkan kreativitas Anda dengan klien yang tepat.
                </p>
                <div>
                    <a href="/register" class="btn btn-modern btn-primary-modern btn-lg me-3">
                        <i class="fas fa-rocket me-2"></i>Mulai Sekarang
                    </a>
                    <a href="#features" class="btn btn-modern btn-secondary-modern btn-lg">
                        <i class="fas fa-info-circle me-2"></i>Pelajari Lebih
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="text-center">
                    <i class="fas fa-palette" style="font-size: 15rem; opacity: 0.1; color: white;"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="features" class="features-section">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="display-4 fw-bold mb-3" style="background: var(--primary-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                    Mengapa Memilih DesignHub?
                </h2>
                <p class="lead text-muted">Platform yang menghubungkan desainer berbakat dengan klien yang membutuhkan</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Komunitas Desainer</h4>
                    <p class="text-muted">Bergabung dengan ribuan desainer profesional dari berbagai bidang keahlian</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Transaksi Aman</h4>
                    <p class="text-muted">Sistem pembayaran yang aman dan terpercaya untuk melindungi semua pihak</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Kualitas Terjamin</h4>
                    <p class="text-muted">Setiap desainer telah diverifikasi dan memiliki portofolio yang dapat diandalkan</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="about" class="py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
    <div class="container text-center">
        <h2 class="display-5 fw-bold mb-4">Siap Memulai Perjalanan Kreatif Anda?</h2>
        <p class="lead mb-4">Bergabunglah dengan DesignHub dan mulailah mengeksplorasi dunia desain yang tak terbatas</p>
        <a href="/register" class="btn btn-modern btn-primary-modern btn-lg">
            <i class="fas fa-arrow-right me-2"></i>Bergabung Sekarang
        </a>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
