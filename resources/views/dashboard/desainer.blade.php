@extends('layouts.app')

@section('title', 'Dashboard Desainer - DesignHub')

@section('content')
<div class="row mb-5">
    <div class="col-12">
        <div class="card-modern p-4 mb-4" style="background: var(--secondary-gradient); color: white; border: none;">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-4 fw-bold mb-3">
                        <i class="fas fa-palette me-3"></i>Selamat Datang, {{ auth()->user()->name }}!
                    </h1>
                    <p class="lead opacity-90 mb-0">Wujudkan kreativitas Anda dan dapatkan penghasilan dari jasa desain</p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="designer-avatar mx-auto mb-3">
                        <i class="fas fa-user-tie fa-5x opacity-80"></i>
                    </div>
                    <div class="badge-modern">
                        <span class="badge fs-6 px-3 py-2" style="background: var(--accent-gradient); color: white; border-radius: 50px;">
                            <i class="fas fa-palette me-1"></i>{{ ucfirst(auth()->user()->role) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-3">
        <div class="card-modern text-center p-4 h-100">
            <div class="card-body">
                <div class="icon-wrapper mb-3">
                    <div class="icon-circle" style="background: var(--success-gradient);">
                        <i class="fas fa-plus-circle fa-2x text-white"></i>
                    </div>
                </div>
                <h5 class="card-title fw-bold mb-3">Tambah Jasa</h5>
                <p class="card-text text-muted mb-4">Buat jasa desain baru untuk ditawarkan ke klien</p>
                <a href="{{ route('desainer.services.create') }}" class="btn btn-modern w-100" style="background: var(--success-gradient); color: white;">
                    <i class="fas fa-plus me-2"></i>Tambah Jasa
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-modern text-center p-4 h-100">
            <div class="card-body">
                <div class="icon-wrapper mb-3">
                    <div class="icon-circle" style="background: var(--primary-gradient);">
                        <i class="fas fa-list fa-2x text-white"></i>
                    </div>
                </div>
                <h5 class="card-title fw-bold mb-3">Kelola Jasa</h5>
                <p class="card-text text-muted mb-4">Edit dan kelola jasa desain yang sudah dibuat</p>
                <a href="{{ route('desainer.services.index') }}" class="btn btn-modern w-100" style="background: var(--primary-gradient); color: white;">
                    <i class="fas fa-edit me-2"></i>Kelola Jasa
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-modern text-center p-4 h-100">
            <div class="card-body">
                <div class="icon-wrapper mb-3">
                    <div class="icon-circle" style="background: var(--warning-gradient);">
                        <i class="fas fa-shopping-bag fa-2x text-white"></i>
                    </div>
                </div>
                <h5 class="card-title fw-bold mb-3">Pesanan Masuk</h5>
                <p class="card-text text-muted mb-4">Pantau dan kelola pesanan dari klien</p>
                <a href="{{ route('desainer.orders.index') }}" class="btn btn-modern w-100" style="background: var(--warning-gradient); color: white;">
                    <i class="fas fa-eye me-2"></i>Lihat Pesanan
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-modern text-center p-4 h-100">
            <div class="card-body">
                <div class="icon-wrapper mb-3">
                    <div class="icon-circle" style="background: var(--accent-gradient);">
                        <i class="fas fa-chart-line fa-2x text-white"></i>
                    </div>
                </div>
                <h5 class="card-title fw-bold mb-3">Analitik</h5>
                <p class="card-text text-muted mb-4">Lihat performa dan statistik penjualan</p>
                <a href="#" class="btn btn-modern w-100" style="background: var(--accent-gradient); color: white;">
                    <i class="fas fa-chart-bar me-2"></i>Lihat Statistik
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="card-modern p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold mb-0">
                    <i class="fas fa-clock me-2 text-warning"></i>Pesanan Terbaru
                </h4>
                <a href="{{ route('desainer.orders.index') }}" class="btn btn-outline-primary btn-sm">
                    Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="order-list">
                <div class="order-item p-3 mb-3 border rounded-3" style="background: linear-gradient(135deg, #f8f9ff 0%, #e8f2ff 100%);">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center mb-2">
                                <h6 class="mb-0 fw-bold me-3">Logo Design untuk Startup Tech</h6>
                                <span class="badge bg-warning">Pending</span>
                            </div>
                            <p class="small text-muted mb-2">Dipesan oleh: Ahmad Rahman • 2 jam yang lalu</p>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-success me-2">Rp 250.000</span>
                                <small class="text-muted">Deadline: 5 hari lagi</small>
                            </div>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-success btn-sm mb-2">Terima</button>
                            <br>
                            <button class="btn btn-outline-danger btn-sm">Tolak</button>
                        </div>
                    </div>
                </div>
                <div class="order-item p-3 mb-3 border rounded-3" style="background: linear-gradient(135deg, #fff8f8 0%, #ffe8e8 100%);">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center mb-2">
                                <h6 class="mb-0 fw-bold me-3">UI/UX Mobile App</h6>
                                <span class="badge bg-success">In Progress</span>
                            </div>
                            <p class="small text-muted mb-2">Dipesan oleh: Sari Dewi • 1 hari yang lalu</p>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-success me-2">Rp 500.000</span>
                                <small class="text-muted">Deadline: 10 hari lagi</small>
                            </div>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-primary btn-sm">Update Progress</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card-modern p-4 mb-4">
            <h5 class="fw-bold mb-3">
                <i class="fas fa-trophy me-2 text-warning"></i>Performa Bulan Ini
            </h5>
            <div class="stats-grid">
                <div class="stat-item text-center p-3 mb-3 bg-light rounded-3">
                    <div class="stat-number display-6 fw-bold text-primary">12</div>
                    <div class="stat-label small text-muted">Jasa Aktif</div>
                </div>
                <div class="stat-item text-center p-3 mb-3 bg-light rounded-3">
                    <div class="stat-number display-6 fw-bold text-success">8</div>
                    <div class="stat-label small text-muted">Pesanan</div>
                </div>
                <div class="stat-item text-center p-3 mb-3 bg-light rounded-3">
                    <div class="stat-number display-6 fw-bold text-warning">4.8</div>
                    <div class="stat-label small text-muted">Rating</div>
                </div>
                <div class="stat-item text-center p-3 bg-light rounded-3">
                    <div class="stat-number display-6 fw-bold text-info">Rp 2.1M</div>
                    <div class="stat-label small text-muted">Pendapatan</div>
                </div>
            </div>
        </div>

        <div class="card-modern p-4">
            <h5 class="fw-bold mb-3">
                <i class="fas fa-star me-2 text-warning"></i>Ulasan Terbaru
            </h5>
            <div class="review-item mb-3 pb-3 border-bottom">
                <div class="d-flex align-items-start">
                    <div class="review-avatar me-3">
                        <i class="fas fa-user-circle fa-2x text-muted"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex align-items-center mb-1">
                            <span class="fw-semibold me-2">Ahmad Rahman</span>
                            <div class="rating">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                            </div>
                        </div>
                        <p class="small text-muted mb-0">"Hasil desain logo sangat memuaskan! Profesional dan tepat waktu."</p>
                    </div>
                </div>
            </div>
            <div class="review-item">
                <div class="d-flex align-items-start">
                    <div class="review-avatar me-3">
                        <i class="fas fa-user-circle fa-2x text-muted"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex align-items-center mb-1">
                            <span class="fw-semibold me-2">Sari Dewi</span>
                            <div class="rating">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star-half-alt text-warning"></i>
                            </div>
                        </div>
                        <p class="small text-muted mb-0">"Kualitas desain bagus, komunikasi juga lancar."</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-12">
        <div class="card-modern p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold mb-0">
                    <i class="fas fa-images me-2 text-info"></i>Portfolio Anda
                </h4>
                <a href="{{ route('desainer.services.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-2"></i>Tambah Jasa
                </a>
            </div>
            <div class="portfolio-grid">
                @php
                    $services = auth()->user()->services()->where('status', 'approved')->latest()->take(6)->get();
                @endphp

                @if($services->count() > 0)
                    <div class="row g-3">
                        @foreach($services as $service)
                            <div class="col-md-6 col-lg-4">
                                <div class="portfolio-item">
                                    @if($service->image)
                                        <img src="{{ asset('storage/' . $service->image) }}" class="portfolio-img" alt="{{ $service->title }}">
                                    @else
                                        <div class="portfolio-placeholder-item">
                                            <i class="fas fa-image fa-2x text-muted"></i>
                                            <p class="text-muted small mt-2">Belum ada gambar</p>
                                        </div>
                                    @endif
                                    <div class="portfolio-overlay">
                                        <h6 class="portfolio-title">{{ Str::limit($service->title, 30) }}</h6>
                                        <p class="portfolio-price">Rp {{ number_format($service->price, 0, ',', '.') }}</p>
                                        <a href="{{ route('desainer.services.edit', $service->id) }}" class="btn btn-outline-light btn-sm">
                                            <i class="fas fa-edit me-1"></i>Edit
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="portfolio-placeholder text-center p-5 border-2 border-dashed rounded-3" style="border-color: #dee2e6 !important;">
                        <i class="fas fa-images fa-4x text-muted mb-3"></i>
                        <h5 class="text-muted">Belum ada portfolio</h5>
                        <p class="text-muted mb-3">Tambahkan jasa desain untuk menampilkan portfolio Anda</p>
                        <a href="{{ route('desainer.services.create') }}" class="btn btn-outline-primary">
                            <i class="fas fa-plus me-2"></i>Tambah Jasa Pertama
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
.icon-circle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.order-item, .stat-item {
    transition: all 0.3s ease;
}

.order-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.stat-number {
    font-size: 2rem;
    line-height: 1;
}

.rating i {
    font-size: 0.8rem;
}

.portfolio-placeholder {
    min-height: 200px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.portfolio-item {
    position: relative;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 200px;
}

.portfolio-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.portfolio-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.portfolio-placeholder-item {
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    color: #6c757d;
}

.portfolio-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(transparent, rgba(0,0,0,0.8));
    color: white;
    padding: 15px;
    transform: translateY(100%);
    transition: transform 0.3s ease;
}

.portfolio-item:hover .portfolio-overlay {
    transform: translateY(0);
}

.portfolio-title {
    margin-bottom: 5px;
    font-size: 0.9rem;
}

.portfolio-price {
    margin-bottom: 10px;
    font-size: 0.8rem;
    opacity: 0.9;
}

@media (max-width: 768px) {
    .display-4 {
        font-size: 2.5rem;
    }
    .card-modern {
        margin-bottom: 1rem;
    }
    .stat-number {
        font-size: 1.5rem;
    }
}
</style>
@endsection
