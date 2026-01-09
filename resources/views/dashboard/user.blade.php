@extends('layouts.app')

@section('title', 'Dashboard User - DesignHub')

@section('content')
<div class="row mb-5">
    <div class="col-12">
        <div class="card-modern p-4 mb-4" style="background: var(--primary-gradient); color: white; border: none;">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-4 fw-bold mb-3">
                        <i class="fas fa-user-circle me-3"></i>Halo, {{ auth()->user()->name }}!
                    </h1>
                    <p class="lead opacity-90 mb-0">Temukan desainer profesional dan wujudkan ide kreatif Anda</p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="user-avatar mx-auto mb-3">
                        <i class="fas fa-user-circle fa-5x opacity-80"></i>
                    </div>
                    <div class="badge-modern">
                        <span class="badge fs-6 px-3 py-2" style="background: var(--accent-gradient); color: white; border-radius: 50px;">
                            <i class="fas fa-crown me-1"></i>{{ ucfirst(auth()->user()->role) }}
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
                    <div class="icon-circle" style="background: var(--accent-gradient);">
                        <i class="fas fa-search fa-2x text-white"></i>
                    </div>
                </div>
                <h5 class="card-title fw-bold mb-3">Jelajah Jasa</h5>
                <p class="card-text text-muted mb-4">Temukan berbagai jasa desain dari desainer berbakat</p>
                <a href="{{ route('user.services') }}" class="btn btn-modern w-100" style="background: var(--accent-gradient); color: white;">
                    <i class="fas fa-arrow-right me-2"></i>Lihat Jasa
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-modern text-center p-4 h-100">
            <div class="card-body">
                <div class="icon-wrapper mb-3">
                    <div class="icon-circle" style="background: var(--success-gradient);">
                        <i class="fas fa-shopping-cart fa-2x text-white"></i>
                    </div>
                </div>
                <h5 class="card-title fw-bold mb-3">Pesanan Saya</h5>
                <p class="card-text text-muted mb-4">Pantau status pesanan dan komunikasi dengan desainer</p>
                <a href="#" class="btn btn-modern w-100" style="background: var(--success-gradient); color: white;">
                    <i class="fas fa-list me-2"></i>Lihat Pesanan
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-modern text-center p-4 h-100">
            <div class="card-body">
                <div class="icon-wrapper mb-3">
                    <div class="icon-circle" style="background: var(--warning-gradient);">
                        <i class="fas fa-heart fa-2x text-white"></i>
                    </div>
                </div>
                <h5 class="card-title fw-bold mb-3">Favorit</h5>
                <p class="card-text text-muted mb-4">Jasa desain favorit Anda untuk akses cepat</p>
                <a href="#" class="btn btn-modern w-100" style="background: var(--warning-gradient); color: white;">
                    <i class="fas fa-heart me-2"></i>Favorit Saya
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-modern text-center p-4 h-100">
            <div class="card-body">
                <div class="icon-wrapper mb-3">
                    <div class="icon-circle" style="background: var(--secondary-gradient);">
                        <i class="fas fa-star fa-2x text-white"></i>
                    </div>
                </div>
                <h5 class="card-title fw-bold mb-3">Ulasan</h5>
                <p class="card-text text-muted mb-4">Berikan ulasan untuk desainer yang telah bekerja</p>
                <a href="#" class="btn btn-modern w-100" style="background: var(--secondary-gradient); color: white;">
                    <i class="fas fa-star me-2"></i>Beri Ulasan
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card-modern p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold mb-0">
                    <i class="fas fa-fire me-2 text-warning"></i>Jasa Populer
                </h4>
                <a href="{{ route('user.services') }}" class="btn btn-outline-primary btn-sm">
                    Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="row g-3">
                @php
                    $popularServices = \App\Models\Service::where('status', 'approved')->latest()->take(4)->get();
                @endphp

                @forelse($popularServices as $service)
                    <div class="col-md-6">
                        <div class="service-card p-3 border rounded-3" style="background: linear-gradient(135deg, #f8f9ff 0%, #e8f2ff 100%);">
                            <div class="d-flex align-items-center mb-2">
                                @if($service->image)
                                    <div class="service-image me-3">
                                        <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                    </div>
                                @else
                                    <div class="service-icon me-3">
                                        <i class="fas fa-palette fa-lg text-primary"></i>
                                    </div>
                                @endif
                                <div>
                                    <h6 class="mb-0 fw-bold">{{ Str::limit($service->title, 25) }}</h6>
                                    <small class="text-muted">Rp {{ number_format($service->price, 0, ',', '.') }}</small>
                                </div>
                            </div>
                            <p class="small text-muted mb-2">{{ Str::limit($service->description, 60) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-success">4.8 <i class="fas fa-star ms-1"></i></span>
                                <a href="{{ route('user.service-detail', $service->id) }}" class="btn btn-primary btn-sm">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-4">
                            <i class="fas fa-palette fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Belum ada jasa tersedia</h5>
                            <p class="text-muted">Jasa akan segera ditambahkan oleh desainer</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card-modern p-4">
            <h5 class="fw-bold mb-3">
                <i class="fas fa-chart-line me-2 text-info"></i>Aktivitas Terbaru
            </h5>
            <div class="activity-list">
                <div class="activity-item d-flex align-items-start mb-3 pb-3 border-bottom">
                    <div class="activity-icon me-3 mt-1">
                        <i class="fas fa-shopping-cart text-success fa-lg"></i>
                    </div>
                    <div class="flex-grow-1">
                        <p class="mb-1 fw-semibold">Pesanan Logo Design</p>
                        <small class="text-muted">2 jam yang lalu</small>
                    </div>
                </div>
                <div class="activity-item d-flex align-items-start mb-3 pb-3 border-bottom">
                    <div class="activity-icon me-3 mt-1">
                        <i class="fas fa-star text-warning fa-lg"></i>
                    </div>
                    <div class="flex-grow-1">
                        <p class="mb-1 fw-semibold">Ulasan diberikan</p>
                        <small class="text-muted">1 hari yang lalu</small>
                    </div>
                </div>
                <div class="activity-item d-flex align-items-start">
                    <div class="activity-icon me-3 mt-1">
                        <i class="fas fa-heart text-danger fa-lg"></i>
                    </div>
                    <div class="flex-grow-1">
                        <p class="mb-1 fw-semibold">Jasa ditambahkan ke favorit</p>
                        <small class="text-muted">3 hari yang lalu</small>
                    </div>
                </div>
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

.service-card {
    transition: all 0.3s ease;
}

.service-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.activity-icon {
    min-width: 30px;
}

@media (max-width: 768px) {
    .display-4 {
        font-size: 2.5rem;
    }
    .card-modern {
        margin-bottom: 1rem;
    }
}
</style>
@endsection
