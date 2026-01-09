@extends('layouts.app')

@section('title', 'Riwayat Order - DesignHub')

@section('styles')
<style>
/* Pure custom modal - no Bootstrap dependencies */
.custom-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1050;
    display: none;
    opacity: 0;
    transition: opacity 0.1s ease;
}

.custom-modal.show {
    display: block;
    opacity: 1;
}

.custom-modal-dialog {
    position: relative;
    width: 90%;
    max-width: 900px;
    margin: 5vh auto;
    background: white;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    max-height: 90vh;
    overflow: hidden;
    display: flex;
    flex-direction: column;
}

.custom-modal-content {
    flex: 1;
    overflow-y: auto;
    max-height: calc(90vh - 120px);
}

.custom-modal-header {
    padding: 1.5rem;
    border-bottom: 1px solid #dee2e6;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.custom-modal-body {
    padding: 1.5rem;
}

.custom-modal-footer {
    padding: 1rem 1.5rem;
    border-top: 1px solid #dee2e6;
    background: #f8f9fa;
    display: flex;
    justify-content: flex-end;
    gap: 0.5rem;
}

.custom-modal .btn-close {
    background: none;
    border: none;
    font-size: 1.5rem;
    color: white;
    cursor: pointer;
    padding: 0;
}

.custom-modal .btn-close:hover {
    color: #ccc;
}

/* Smooth image loading */
.custom-modal img {
    opacity: 0;
    transition: opacity 0.3s ease;
}

.custom-modal.show img {
    opacity: 1;
}
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="hero-section text-center py-4 mb-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 20px; color: white;">
        <div class="container">
            <h1 class="display-5 fw-bold mb-2">
                <i class="fas fa-history me-3"></i>Riwayat Order
            </h1>
            <p class="lead mb-0">Pantau status pesanan jasa desain Anda</p>
        </div>
    </div>

    <div class="container">
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

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">
                <i class="fas fa-list me-2"></i>Daftar Pesanan
            </h2>
            <a href="{{ route('user.services') }}" class="btn btn-modern btn-primary">
                <i class="fas fa-plus me-2"></i>Pesan Jasa Baru
            </a>
        </div>

        <div class="card card-modern">
            <div class="card-body">
                @forelse($orders as $order)
                    <div class="order-item mb-3 p-3 border rounded">
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <div class="order-number">
                                    <small class="text-muted">Order #{{ $order->id }}</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="service-info">
                                    <h6 class="mb-1">{{ $order->service->title }}</h6>
                                    <small class="text-muted">
                                        <i class="fas fa-user me-1"></i>{{ $order->service->designer->name ?? 'N/A' }}
                                    </small>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="price">
                                    <strong>Rp {{ number_format($order->service->price, 0, ',', '.') }}</strong>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="status">
                                    @php
                                        $statusClasses = [
                                            'menunggu' => 'warning',
                                            'diproses' => 'info',
                                            'selesai' => 'success',
                                            'dibatalkan' => 'danger'
                                        ];
                                        $statusLabels = [
                                            'menunggu' => 'Menunggu',
                                            'diproses' => 'Diproses',
                                            'selesai' => 'Selesai',
                                            'dibatalkan' => 'Dibatalkan'
                                        ];
                                    @endphp
                                    <span class="badge bg-{{ $statusClasses[$order->status] ?? 'secondary' }}">
                                        {{ $statusLabels[$order->status] ?? ucfirst($order->status) }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="order-date">
                                    <small class="text-muted">
                                        <i class="fas fa-calendar me-1"></i>{{ $order->created_at->format('d M Y') }}
                                    </small>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="actions">
                                    <button class="btn btn-sm btn-outline-primary" onclick="openCustomModal('orderModal{{ $order->id }}')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Detail Modal - Pure Custom Implementation -->
                    <div class="custom-modal" id="orderModal{{ $order->id }}">
                        <div class="custom-modal-dialog">
                            <div class="custom-modal-content">
                                <div class="custom-modal-header">
                                    <h5 class="custom-modal-title"><i class="fas fa-receipt me-2"></i>Detail Order #{{ $order->id }}</h5>
                                    <button type="button" class="btn-close" onclick="closeCustomModal('orderModal{{ $order->id }}')">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <div class="custom-modal-body">
                                    <div class="row">
                                        <!-- Service Image & Basic Info -->
                                        <div class="col-md-6 mb-4">
                                            <div class="service-image-container" style="background: #f8f9fa; border-radius: 12px; padding: 12px; margin-bottom: 16px;">
                                                @if($order->service->image)
                                                    <img src="{{ asset('storage/' . $order->service->image) }}" alt="{{ $order->service->title }}" class="img-fluid rounded" style="max-height: 250px; width: 100%; object-fit: cover;">
                                                @else
                                                    <div style="height: 250px; display: flex; align-items: center; justify-content: center; background: #e9ecef; border-radius: 8px;">
                                                        <div class="text-center">
                                                            <i class="fas fa-image fa-3x text-muted mb-2"></i>
                                                            <p class="text-muted">Tidak ada gambar</p>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="service-info">
                                                <h5 class="mb-2">{{ $order->service->title }}</h5>
                                                <p class="text-muted mb-3"><strong>Desainer:</strong> {{ $order->service->designer->name ?? 'N/A' }}</p>
                                                <p class="text-success mb-0"><strong style="font-size: 1.2rem;">Rp {{ number_format($order->service->price, 0, ',', '.') }}</strong></p>
                                            </div>
                                        </div>
                                        
                                        <!-- Deskripsi & Status -->
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <h6 class="mb-3"><i class="fas fa-align-left text-primary me-2"></i>Deskripsi Jasa</h6>
                                                <p class="text-muted" style="line-height: 1.6; word-wrap: break-word; white-space: pre-wrap;">{{ $order->service->description }}</p>
                                            </div>
                                            
                                            <div class="mb-4">
                                                <h6 class="mb-3"><i class="fas fa-info-circle text-info me-2"></i>Status Order</h6>
                                                <p class="mb-2">
                                                    @php
                                                        $statusClasses = [
                                                            'menunggu' => 'warning',
                                                            'diproses' => 'info',
                                                            'selesai' => 'success',
                                                            'dibatalkan' => 'danger'
                                                        ];
                                                        $statusLabels = [
                                                            'menunggu' => 'Menunggu',
                                                            'diproses' => 'Diproses',
                                                            'selesai' => 'Selesai',
                                                            'dibatalkan' => 'Dibatalkan'
                                                        ];
                                                    @endphp
                                                    <span class="badge bg-{{ $statusClasses[$order->status] ?? 'secondary' }} p-2 fs-6">
                                                        {{ $statusLabels[$order->status] ?? ucfirst($order->status) }}
                                                    </span>
                                                </p>
                                            </div>
                                            
                                            <div class="mb-4">
                                                <h6 class="mb-3"><i class="fas fa-calendar text-secondary me-2"></i>Informasi Tanggal</h6>
                                                <p class="mb-1"><small class="text-muted"><strong>Tanggal Order:</strong> {{ $order->created_at->format('d M Y H:i') }}</small></p>
                                                <p class="mb-0"><small class="text-muted"><strong>Update Terakhir:</strong> {{ $order->updated_at->format('d M Y H:i') }}</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-modal-footer">
                                    <button type="button" class="btn btn-secondary" onclick="closeCustomModal('orderModal{{ $order->id }}')">Tutup</button>
                                    @if(in_array($order->status, ['menunggu', 'diproses']))
                                        <form method="POST" action="{{ route('user.order.cancel', $order->id) }}" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-times me-2"></i>Batalkan Pesanan
                                            </button>
                                        </form>
                                    @elseif($order->status === 'dibatalkan')
                                        <form method="POST" action="{{ route('user.order.delete', $order->id) }}" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus riwayat pesanan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-trash me-2"></i>Hapus Riwayat
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Belum ada pesanan</h5>
                        <p class="text-muted">Mulai pesan jasa desain favorit Anda</p>
                        <a href="{{ route('user.services') }}" class="btn btn-modern btn-primary">
                            <i class="fas fa-plus me-2"></i>Pesan Jasa Sekarang
                        </a>
                    </div>
                @endforelse

                @if($orders->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $orders->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Pure custom modal functions - no Bootstrap dependencies
function openCustomModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('show');
        document.body.style.overflow = 'hidden'; // Prevent background scroll
    }
}

function closeCustomModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('show');
        document.body.style.overflow = ''; // Restore background scroll
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Handle ESC key to close modals
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const openModal = document.querySelector('.custom-modal.show');
            if (openModal) {
                openModal.classList.remove('show');
                document.body.style.overflow = '';
            }
        }
    });

    // Handle backdrop click to close modals
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('custom-modal')) {
            e.target.classList.remove('show');
            document.body.style.overflow = '';
        }
    });
});
</script>
@endsection