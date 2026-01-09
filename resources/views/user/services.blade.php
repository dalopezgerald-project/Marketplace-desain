@extends('layouts.app')

@section('title', 'Jasa Desain - DesignHub')

@section('content')
<div class="container-fluid">
    <!-- Hero Section -->
    <div class="hero-section text-center py-5 mb-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 20px; color: white;">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">
                <i class="fas fa-palette me-3"></i>Jasa Desain Terbaik
            </h1>
            <p class="lead mb-0">Temukan desainer profesional untuk kebutuhan desain Anda</p>
        </div>
    </div>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4">
            @forelse($services as $service)
                <div class="col-md-6 col-lg-4">
                    <div class="card card-modern service-card h-100">
                        <div class="card-img-container">
                            @if($service->image)
                                <img src="{{ asset('storage/' . $service->image) }}" class="card-img-top" alt="{{ $service->title }}">
                            @else
                                <div class="no-image-placeholder">
                                    <i class="fas fa-palette fa-3x text-muted"></i>
                                    <p class="text-muted mt-2 small">Poster belum tersedia</p>
                                </div>
                            @endif
                            <div class="card-price-badge">
                                <span class="badge bg-primary fs-6 px-3 py-2">{{ $service->formatted_price }}</span>
                            </div>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title mb-2">{{ Str::limit($service->title, 50) }}</h5>
                            <p class="card-text text-muted flex-grow-1 mb-3">
                                {{ Str::limit($service->description, 100) }}
                            </p>
                            <div class="designer-info mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="designer-avatar me-2">
                                        <i class="fas fa-user-circle fa-lg text-primary"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Oleh</small>
                                        <strong class="text-dark">{{ $service->designer->name }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-auto">
                                <div class="d-flex gap-2">
                                    <a href="{{ route('user.service-detail', $service->id) }}" class="btn btn-outline-primary flex-fill">
                                        <i class="fas fa-eye me-1"></i>Lihat Detail
                                    </a>
                                    <form method="POST" action="{{ route('user.place-order', $service->id) }}" class="flex-fill">
                                        @csrf
                                        <button type="submit" class="btn btn-success w-100">
                                            <i class="fas fa-shopping-cart me-1"></i>Pesan
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <div class="empty-state">
                            <i class="fas fa-search fa-4x text-muted mb-4"></i>
                            <h4 class="text-muted mb-3">Belum ada jasa tersedia</h4>
                            <p class="text-muted">Jasa desain akan segera ditambahkan oleh desainer kami</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>

<style>
.card-modern {
    border: none;
    border-radius: 15px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    overflow: hidden;
}

.card-modern:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.service-card .card-img-container {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.service-card .card-img-top {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.service-card:hover .card-img-top {
    transform: scale(1.05);
}

.no-image-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
}

.card-price-badge {
    position: absolute;
    top: 15px;
    right: 15px;
}

.designer-avatar {
    width: 35px;
    height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: rgba(255,255,255,0.9);
}

.empty-state {
    max-width: 400px;
    margin: 0 auto;
}

.hero-section {
    margin-bottom: 3rem !important;
}
</style>
@endsection
