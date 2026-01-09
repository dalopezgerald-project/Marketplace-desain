@extends('layouts.app')

@section('title', $service->title . ' - DesignHub')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="card card-modern">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h1 class="h2 mb-2">{{ $service->title }}</h1>
                            <p class="text-muted mb-3">
                                <i class="fas fa-user-circle me-2"></i>
                                Oleh <strong>{{ $service->designer->name }}</strong>
                                {!! $service->designer->role_badge !!}
                            </p>
                        </div>
                        {!! $service->status_badge !!}
                    </div>

                    <div class="service-description mb-4">
                        @if($service->image)
                            <div class="service-poster mb-4">
                                <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" class="img-fluid rounded shadow">
                            </div>
                        @endif
                        <h5 class="mb-3">Deskripsi Jasa</h5>
                        <p class="lead">{{ $service->description }}</p>
                    </div>

                    <div class="service-meta">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="meta-item mb-3">
                                    <i class="fas fa-calendar text-primary me-2"></i>
                                    <strong>Dibuat:</strong> {{ $service->created_at->format('d M Y') }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="meta-item mb-3">
                                    <i class="fas fa-clock text-primary me-2"></i>
                                    <strong>Terakhir Update:</strong> {{ $service->updated_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card card-modern sticky-top" style="top: 2rem;">
                <div class="card-body">
                    <div class="price-section text-center mb-4">
                        <h3 class="text-success mb-0">{{ $service->formatted_price }}</h3>
                        <small class="text-muted">Harga final, tanpa biaya tersembunyi</small>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('user.place-order', $service->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                            <i class="fas fa-shopping-cart me-2"></i>Order Sekarang
                        </button>
                    </form>

                    <div class="service-highlights">
                        <h6 class="mb-3">
                            <i class="fas fa-star text-warning me-2"></i>Yang Anda Dapatkan
                        </h6>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                File desain dalam format siap pakai
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                Revisi hingga 3x tanpa biaya tambahan
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                Konsultasi langsung dengan desainer
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                Garansi kepuasan 100%
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Designer Profile Section -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card card-modern">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-user-circle me-2"></i>Tentang Desainer
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-2 text-center">
                            <div class="designer-avatar mb-3">
                                <i class="fas fa-user-circle fa-4x text-primary"></i>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <h4>{{ $service->designer->name }}</h4>
                            <p class="text-muted mb-3">{{ $service->designer->email }}</p>
                            <p class="mb-3">
                                Desainer profesional yang bergabung sejak {{ $service->designer->created_at->format('M Y') }}.
                                Telah menyelesaikan {{ $service->designer->orders()->where('status', 'selesai')->count() }} project.
                            </p>
                            <div class="designer-stats">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="stat-item text-center">
                                            <div class="h4 text-primary mb-0">{{ $service->designer->services()->count() }}</div>
                                            <small class="text-muted">Jasa Ditawarkan</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="stat-item text-center">
                                            <div class="h4 text-success mb-0">{{ $service->designer->orders()->where('status', 'selesai')->count() }}</div>
                                            <small class="text-muted">Project Selesai</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="stat-item text-center">
                                            <div class="h4 text-warning mb-0">{{ $service->designer->orders()->where('status', 'diproses')->count() }}</div>
                                            <small class="text-muted">Sedang Dikerjakan</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="stat-item text-center">
                                            <div class="h4 text-info mb-0">{{ $service->designer->created_at->diffInYears() }} tahun</div>
                                            <small class="text-muted">Pengalaman</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card-modern {
    border: none;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.card-modern:hover {
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}

.price-section {
    padding: 2rem;
    background: linear-gradient(135deg, #f8f9ff 0%, #e8f2ff 100%);
    border-radius: 15px;
    margin: -1rem -1rem 1rem -1rem;
}

.btn-primary {
    background: var(--primary-gradient);
    border: none;
    padding: 0.75rem 2rem;
    font-weight: 600;
    border-radius: 25px;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
}

.designer-avatar {
    margin-bottom: 1rem;
}

.stat-item {
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 10px;
    margin-bottom: 1rem;
}

@media (max-width: 768px) {
    .sticky-top {
        position: static !important;
    }

    .price-section {
        margin: 0 0 1rem 0;
        border-radius: 15px;
    }
}
</style>
@endsection
