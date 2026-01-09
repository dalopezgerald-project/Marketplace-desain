@extends('layouts.app')

@section('title', 'Jasa Saya - Dashboard Desainer')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 px-0">
            <div class="card-modern sidebar-desainer">
                <div class="card-body p-4">
                    <h5 class="mb-4">
                        <i class="fas fa-palette me-2"></i>Dashboard Desainer
                    </h5>
                    <nav class="nav flex-column">
                        <a class="nav-link active" href="{{ route('desainer.services.index') }}">
                            <i class="fas fa-palette me-2"></i>Jasa Saya
                        </a>
                        <a class="nav-link" href="{{ route('desainer.orders.index') }}">
                            <i class="fas fa-shopping-cart me-2"></i>Order Masuk
                        </a>
                        <a class="nav-link" href="{{ route('desainer.services.create') }}">
                            <i class="fas fa-plus me-2"></i>Tambah Jasa
                        </a>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h2 class="mb-0">
                    <i class="fas fa-palette me-2"></i>Jasa Saya
                </h2>
                <a href="{{ route('desainer.services.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah Jasa Baru
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

            @if($services->count() > 0)
                <div class="row g-4">
                    @foreach($services as $service)
                        <div class="col-md-6 col-lg-4">
                            <div class="card card-modern service-card h-100">
                                <div class="card-img-container">
                                    @if($service->image)
                                        <img src="{{ asset('storage/' . $service->image) }}" class="card-img-top" alt="{{ $service->title }}">
                                    @else
                                        <div class="no-image-placeholder">
                                            <i class="fas fa-image fa-3x text-muted"></i>
                                            <p class="text-muted mt-2">Belum ada poster</p>
                                        </div>
                                    @endif
                                    <div class="card-status-badge">
                                        <span class="badge
                                            @if($service->status == 'approved') bg-success
                                            @elseif($service->status == 'pending') bg-warning text-dark
                                            @else bg-danger
                                            @endif">
                                            @if($service->status == 'approved')
                                                <i class="fas fa-check me-1"></i>Disetujui
                                            @elseif($service->status == 'pending')
                                                <i class="fas fa-clock me-1"></i>Menunggu
                                            @else
                                                <i class="fas fa-times me-1"></i>Ditolak
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ Str::limit($service->title, 40) }}</h5>
                                    <p class="card-text text-muted flex-grow-1">
                                        {{ Str::limit($service->description, 80) }}
                                    </p>
                                    <div class="mt-auto">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span class="h5 text-primary mb-0">Rp {{ number_format($service->price, 0, ',', '.') }}</span>
                                            <small class="text-muted">{{ $service->created_at->diffForHumans() }}</small>
                                        </div>
                                        <div class="btn-group w-100" role="group">
                                            @if($service->status !== 'approved')
                                                <a href="{{ route('desainer.services.edit', $service->id) }}" class="btn btn-outline-primary btn-sm">
                                                    <i class="fas fa-edit me-1"></i>Edit
                                                </a>
                                                <button class="btn btn-outline-danger btn-sm" onclick="confirmDelete({{ $service->id }})">
                                                    <i class="fas fa-trash me-1"></i>Hapus
                                                </button>
                                            @else
                                                <a href="{{ route('desainer.services.edit', $service->id) }}" class="btn btn-outline-warning btn-sm flex-grow-1">
                                                    <i class="fas fa-edit me-1"></i>Update (perlu approval)
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <div class="empty-state">
                        <i class="fas fa-palette fa-4x text-muted mb-4"></i>
                        <h4 class="text-muted mb-3">Belum ada jasa</h4>
                        <p class="text-muted mb-4">Mulai tawarkan jasa desain Anda kepada klien</p>
                        <a href="{{ route('desainer.services.create') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-plus me-2"></i>Tambah Jasa Pertama
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus jasa ini?</p>
                <p class="text-muted">Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.card-modern {
    border: none;
    border-radius: 15px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card-modern:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
}

.service-card .card-img-container {
    position: relative;
    height: 200px;
    overflow: hidden;
    border-radius: 15px 15px 0 0;
}

.service-card .card-img-top {
    width: 100%;
    height: 100%;
    object-fit: cover;
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

.card-status-badge {
    position: absolute;
    top: 10px;
    right: 10px;
}

.sidebar-desainer {
    min-height: 100vh;
    border-right: 1px solid rgba(0,0,0,0.1);
}

.empty-state {
    max-width: 400px;
    margin: 0 auto;
}

@media (max-width: 768px) {
    .sidebar-desainer {
        min-height: auto;
        border-right: none;
        border-bottom: 1px solid rgba(0,0,0,0.1);
    }
}
</style>

<script>
function confirmDelete(serviceId) {
    document.getElementById('deleteForm').action = '{{ url("/desainer/services") }}/' + serviceId;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
@endsection
