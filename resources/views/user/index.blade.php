@section('content')
<div class="container">
    <h3>Daftar Jasa</h3>

    <div class="row">
        @forelse($services as $service)
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5>{{ $service->title }}</h5>
                    <p>{{ $service->description }}</p>
                    <p><strong>Rp {{ number_format($service->price) }}</strong></p>

                    <form action="{{ route('user.orders.store', $service->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-primary w-100">
                            Order Jasa
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
            <p>Tidak ada jasa tersedia</p>
        @endforelse
    </div>
</div>
@endsection
=======
@extends('layouts.app')

@section('title', 'Jelajah Jasa Desain')

@section('content')
<div class="container-fluid">
    <!-- Hero Section -->
    <div class="hero-section text-center py-5 mb-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 20px; color: white;">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">
                <i class="fas fa-palette me-3"></i>DesignHub Marketplace
            </h1>
            <p class="lead mb-4">Temukan jasa desain profesional untuk kebutuhan Anda</p>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-lg" placeholder="Cari jasa desain..." id="searchInput">
                        <button class="btn btn-light btn-lg" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Services Grid -->
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">
                <i class="fas fa-th-large me-2"></i>Jasa Tersedia
            </h2>
            <a href="{{ route('user.order-history') }}" class="btn btn-modern btn-outline-primary">
                <i class="fas fa-history me-2"></i>Riwayat Order
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row" id="servicesContainer">
            @forelse($services as $service)
            <div class="col-lg-4 col-md-6 mb-4 service-card">
                <div class="card card-modern h-100">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-start mb-3">
                            <div class="flex-grow-1">
                                <h5 class="card-title fw-bold">{{ $service->title }}</h5>
                                <p class="text-muted small mb-2">
                                    <i class="fas fa-user-circle me-1"></i>
                                    Oleh {{ $service->designer->name }}
                                </p>
                            </div>
                            {!! $service->status_badge !!}
                        </div>

                        <p class="card-text flex-grow-1">{{ Str::limit($service->description, 120) }}</p>

                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="h4 text-success fw-bold mb-0">{{ $service->formatted_price }}</span>
                                <small class="text-muted">
                                    <i class="fas fa-calendar me-1"></i>
                                    {{ $service->created_at->diffForHumans() }}
                                </small>
                            </div>

                            <div class="d-grid gap-2">
                                <a href="{{ route('user.service-detail', $service->id) }}"
                                   class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-eye me-1"></i>Lihat Detail
                                </a>
                                <form action="{{ route('user.place-order', $service->id) }}" method="POST" class="mt-2">
                                    @csrf
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fas fa-shopping-cart me-2"></i>Order Sekarang
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="fas fa-palette fa-4x text-muted mb-4"></i>
                <h4 class="text-muted mb-3">Belum ada jasa tersedia</h4>
                <p class="text-muted">Jasa desain akan segera ditambahkan oleh desainer kami.</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($services->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $services->links() }}
        </div>
        @endif
    </div>
</div>

<style>
.hero-section {
    margin-top: -2rem;
    margin-bottom: 3rem;
}

.service-card {
    transition: all 0.3s ease;
}

.service-card:hover {
    transform: translateY(-5px);
}

.card-modern {
    border: none;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.card-modern:hover {
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    transform: translateY(-5px);
}

.btn-modern {
    border-radius: 25px;
    padding: 0.5rem 1.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

@media (max-width: 768px) {
    .hero-section {
        margin-top: 0;
        border-radius: 0;
    }

    .display-4 {
        font-size: 2rem;
    }
}
</style>

<script>
document.getElementById('searchInput').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const serviceCards = document.querySelectorAll('.service-card');

    serviceCards.forEach(card => {
        const title = card.querySelector('.card-title').textContent.toLowerCase();
        const description = card.querySelector('.card-text').textContent.toLowerCase();
        const designer = card.querySelector('.text-muted').textContent.toLowerCase();

        if (title.includes(searchTerm) || description.includes(searchTerm) || designer.includes(searchTerm)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
});
</script>
@endsection
