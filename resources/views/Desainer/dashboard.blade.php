@extends('layouts.app')

@section('title', 'Dashboard Desainer - DesignHub')

@section('content')
<div class="container-fluid">
    <!-- Hero Section -->
    <div class="hero-section text-center py-4 mb-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 20px; color: white;">
        <div class="container">
            <h1 class="display-5 fw-bold mb-2">
                <i class="fas fa-palette me-3"></i>Dashboard Desainer
            </h1>
            <p class="lead mb-0">Kelola jasa desain Anda dan pantau pesanan masuk</p>
        </div>
    </div>

    <div class="container">
        <!-- Action Buttons -->
        <div class="row mb-4">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h2 class="mb-0">
                    <i class="fas fa-tachometer-alt me-2"></i>Ringkasan Bisnis
                </h2>
                <div>
                    <a href="{{ route('desainer.services.create') }}" class="btn btn-modern btn-primary me-2">
                        <i class="fas fa-plus me-2"></i>Tambah Jasa Baru
                    </a>
                    <a href="{{ route('desainer.services.index') }}" class="btn btn-modern btn-outline-primary">
                        <i class="fas fa-list me-2"></i>Kelola Jasa
                    </a>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="card-modern p-4 text-center h-100" style="background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%); color: white;">
                    <div class="card-icon mb-3">
                        <i class="fas fa-check-circle fa-2x"></i>
                    </div>
                    <h3 class="mt-2 mb-1">{{ auth()->user()->services()->where('status','approved')->count() }}</h3>
                    <h6 class="text-white-50 mb-0">Jasa Aktif</h6>
                    <small class="text-white-75">Siap dipesan customer</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-modern p-4 text-center h-100" style="background: linear-gradient(135deg, #FF9800 0%, #F57C00 100%); color: white;">
                    <div class="card-icon mb-3">
                        <i class="fas fa-clock fa-2x"></i>
                    </div>
                    <h3 class="mt-2 mb-1">{{ auth()->user()->services()->where('status','pending')->count() }}</h3>
                    <h6 class="text-white-50 mb-0">Menunggu Persetujuan</h6>
                    <small class="text-white-75">Dalam review admin</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-modern p-4 text-center h-100" style="background: linear-gradient(135deg, #2196F3 0%, #1976D2 100%); color: white;">
                    <div class="card-icon mb-3">
                        <i class="fas fa-shopping-cart fa-2x"></i>
                    </div>
                    <h3 class="mt-2 mb-1">{{ \App\Models\Order::whereHas('service', function($q) { $q->where('designer_id', auth()->id()); })->count() }}</h3>
                    <h6 class="text-white-50 mb-0">Total Order</h6>
                    <small class="text-white-75">Semua pesanan</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-modern p-4 text-center h-100" style="background: linear-gradient(135deg, #9C27B0 0%, #7B1FA2 100%); color: white;">
                    <div class="card-icon mb-3">
                        <i class="fas fa-star fa-2x"></i>
                    </div>
                    <h3 class="mt-2 mb-1">{{ auth()->user()->services()->count() }}</h3>
                    <h6 class="text-white-50 mb-0">Total Jasa</h6>
                    <small class="text-white-75">Portfolio lengkap</small>
                </div>
            </div>
        </div>

        <!-- Recent Orders & Services -->
        <div class="row">
            <!-- Recent Orders -->
            <div class="col-lg-8 mb-4">
                <div class="card card-modern">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-shopping-cart me-2"></i>Order Terbaru
                        </h5>
                        <a href="{{ route('desainer.orders.index') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-eye me-1"></i>Lihat Semua
                        </a>
                    </div>
                    <div class="card-body">
                        @php
                            $recentOrders = \App\Models\Order::whereHas('service', function($q) {
                                $q->where('designer_id', auth()->id());
                            })->with('service','user')->latest()->limit(5)->get();
                        @endphp

                        @forelse($recentOrders as $order)
                            <div class="order-item d-flex align-items-center p-3 mb-3 border rounded hover-shadow">
                                <div class="order-icon me-3">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <i class="fas fa-shopping-bag"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ $order->service->title }}</h6>
                                    <p class="text-muted mb-1">
                                        <i class="fas fa-user me-1"></i>{{ $order->user->name }} •
                                        <i class="fas fa-calendar me-1"></i>{{ $order->created_at->format('d M Y') }}
                                    </p>
                                    <div class="d-flex align-items-center">
                                        <span class="badge me-2
                                            @if($order->status == 'menunggu') bg-warning
                                            @elseif($order->status == 'diproses') bg-info
                                            @elseif($order->status == 'selesai') bg-success
                                            @else bg-danger
                                            @endif">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                        <small class="text-muted">Rp {{ number_format($order->service->price, 0, ',', '.') }}</small>
                                    </div>
                                </div>
                                <div class="order-actions">
                                    <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#orderModal{{ $order->id }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Order Detail Modal -->
                            <div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Detail Order #{{ $order->id }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h6>Informasi Customer</h6>
                                                    <p><strong>Nama:</strong> {{ $order->user->name }}</p>
                                                    <p><strong>Email:</strong> {{ $order->user->email }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6>Informasi Jasa</h6>
                                                    <p><strong>Judul:</strong> {{ $order->service->title }}</p>
                                                    <p><strong>Harga:</strong> Rp {{ number_format($order->service->price, 0, ',', '.') }}</p>
                                                    <p><strong>Status:</strong>
                                                        <span class="badge
                                                            @if($order->status == 'menunggu') bg-warning
                                                            @elseif($order->status == 'diproses') bg-info
                                                            @elseif($order->status == 'selesai') bg-success
                                                            @else bg-danger
                                                            @endif">
                                                            {{ ucfirst($order->status) }}
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-12">
                                                    <h6>Timeline Order</h6>
                                                    <div class="timeline">
                                                        <div class="timeline-item">
                                                            <div class="timeline-marker bg-success"></div>
                                                            <div class="timeline-content">
                                                                <h6>Dipesan</h6>
                                                                <small>{{ $order->created_at->format('d M Y H:i') }}</small>
                                                            </div>
                                                        </div>
                                                        @if($order->status != 'menunggu')
                                                            <div class="timeline-item">
                                                                <div class="timeline-marker bg-info"></div>
                                                                <div class="timeline-content">
                                                                    <h6>Diproses</h6>
                                                                    <small>Status diperbarui</small>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if($order->status == 'selesai')
                                                            <div class="timeline-item">
                                                                <div class="timeline-marker bg-success"></div>
                                                                <div class="timeline-content">
                                                                    <h6>Selesai</h6>
                                                                    <small>Order telah selesai</small>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="d-flex gap-2">
                                                @if($order->status != 'diproses')
                                                    <a href="{{ route('desainer.order.update-status', [$order->id, 'diproses']) }}" class="btn btn-info btn-sm">
                                                        <i class="fas fa-play me-1"></i>Mulai Proses
                                                    </a>
                                                @endif
                                                @if($order->status != 'selesai')
                                                    <a href="{{ route('desainer.order.update-status', [$order->id, 'selesai']) }}" class="btn btn-success btn-sm">
                                                        <i class="fas fa-check me-1"></i>Selesai
                                                    </a>
                                                @endif
                                                @if($order->status != 'menunggu')
                                                    <a href="{{ route('desainer.order.update-status', [$order->id, 'menunggu']) }}" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-pause me-1"></i>Tunda
                                                    </a>
                                                @endif
                                            </div>
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5">
                                <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Belum ada order masuk</h5>
                                <p class="text-muted">Order dari customer akan muncul di sini</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Quick Actions & Recent Services -->
            <div class="col-lg-4">
                <!-- Quick Actions -->
                <div class="card card-modern mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-bolt me-2"></i>Aksi Cepat
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('desainer.services.create') }}" class="btn btn-outline-success">
                                <i class="fas fa-plus me-2"></i>Tambah Jasa Baru
                            </a>
                            <a href="{{ route('desainer.services.index') }}" class="btn btn-outline-primary">
                                <i class="fas fa-edit me-2"></i>Kelola Jasa Saya
                            </a>
                            <a href="{{ route('desainer.orders.index') }}" class="btn btn-outline-info">
                                <i class="fas fa-list me-2"></i>Lihat Semua Order
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Recent Services -->
                <div class="card card-modern">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-palette me-2"></i>Jasa Terbaru
                        </h5>
                    </div>
                    <div class="card-body">
                        @php
                            $recentServices = auth()->user()->services()->latest()->limit(3)->get();
                        @endphp

                        @forelse($recentServices as $service)
                            <div class="service-item d-flex align-items-center mb-3 pb-3 border-bottom">
                                <div class="service-icon me-3">
                                    <div class="bg-primary text-white rounded d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="fas fa-image"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ Str::limit($service->title, 25) }}</h6>
                                    <div class="d-flex align-items-center">
                                        <span class="badge me-2
                                            @if($service->status == 'approved') bg-success
                                            @elseif($service->status == 'pending') bg-warning
                                            @else bg-danger
                                            @endif">
                                            {{ ucfirst($service->status) }}
                                        </span>
                                        <small class="text-muted">Rp {{ number_format($service->price, 0, ',', '.') }}</small>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-3">
                                <i class="fas fa-palette fa-2x text-muted mb-2"></i>
                                <p class="text-muted mb-0">Belum ada jasa</p>
                            </div>
                        @endforelse

                        @if($recentServices->count() > 0)
                            <div class="text-center mt-3">
                                <a href="{{ route('desainer.services.index') }}" class="btn btn-outline-info btn-sm">
                                    Lihat Semua Jasa
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.hover-shadow:hover {
    box-shadow: 0 4px 8px rgba(0,0,0,0.1) !important;
    transform: translateY(-2px);
    transition: all 0.3s ease;
}

.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-marker {
    position: absolute;
    left: -35px;
    top: 5px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
}

.timeline-item:not(:last-child)::before {
    content: '';
    position: absolute;
    left: -31px;
    top: 17px;
    width: 2px;
    height: calc(100% + 10px);
    background: #e9ecef;
}

.timeline-content h6 {
    margin-bottom: 2px;
    font-size: 0.9rem;
}

.timeline-content small {
    color: #6c757d;
    font-size: 0.8rem;
}

.card-modern {
    border: none;
    border-radius: 15px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.card-icon {
    opacity: 0.8;
}
</style>
@endsection

            @if($recent->isEmpty())
                <div class="p-4 text-center text-muted">Belum ada order</div>
            @else
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Service</th>
                                <th>Pemesan</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recent as $o)
                                <tr>
                                    <td>{{ $o->id }}</td>
                                    <td>{{ $o->service->title ?? '-' }}</td>
                                    <td>{{ $o->user->name ?? '-' }}</td>
                                    <td>Rp {{ number_format($o->price ?? ($o->service->price ?? 0),0,',','.') }}</td>
                                    <td>{{ ucfirst($o->status) }}</td>
                                    <td>{{ $o->created_at->format('d M Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
