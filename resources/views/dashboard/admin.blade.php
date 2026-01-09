@extends('layouts.app')

@section('title', 'Admin Dashboard - DesignHub')

@section('content')
<div class="row mb-5">
    <div class="col-12">
        <div class="card-modern p-4 mb-4" style="background: var(--primary-gradient); color: white; border: none;">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-4 fw-bold mb-3">
                        <i class="fas fa-cog me-3"></i>Admin Dashboard
                    </h1>
                    <p class="lead opacity-90 mb-0">Kelola platform DesignHub dengan efisien dan profesional</p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="admin-avatar mx-auto mb-3">
                        <i class="fas fa-user-shield fa-5x opacity-80"></i>
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
                    <div class="icon-circle" style="background: var(--primary-gradient);">
                        <i class="fas fa-users fa-2x text-white"></i>
                    </div>
                </div>
                <h5 class="card-title fw-bold mb-3">Kelola User</h5>
                <p class="card-text text-muted mb-4">CRUD Admin, Desainer, dan User</p>
                <a href="#" class="btn btn-modern w-100" style="background: var(--primary-gradient); color: white;">
                    <i class="fas fa-users-cog me-2"></i>Kelola User
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-modern text-center p-4 h-100">
            <div class="card-body">
                <div class="icon-wrapper mb-3">
                    <div class="icon-circle" style="background: var(--success-gradient);">
                        <i class="fas fa-palette fa-2x text-white"></i>
                    </div>
                </div>
                <h5 class="card-title fw-bold mb-3">Moderasi Jasa</h5>
                <p class="card-text text-muted mb-4">Approve atau reject jasa desain</p>
                <a href="#" class="btn btn-modern w-100" style="background: var(--success-gradient); color: white;">
                    <i class="fas fa-check-circle me-2"></i>Moderasi
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-modern text-center p-4 h-100">
            <div class="card-body">
                <div class="icon-wrapper mb-3">
                    <div class="icon-circle" style="background: var(--warning-gradient);">
                        <i class="fas fa-chart-bar fa-2x text-white"></i>
                    </div>
                </div>
                <h5 class="card-title fw-bold mb-3">Laporan</h5>
                <p class="card-text text-muted mb-4">Analitik dan statistik platform</p>
                <a href="#" class="btn btn-modern w-100" style="background: var(--warning-gradient); color: white;">
                    <i class="fas fa-chart-line me-2"></i>Lihat Laporan
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-modern text-center p-4 h-100">
            <div class="card-body">
                <div class="icon-wrapper mb-3">
                    <div class="icon-circle" style="background: var(--secondary-gradient);">
                        <i class="fas fa-cogs fa-2x text-white"></i>
                    </div>
                </div>
                <h5 class="card-title fw-bold mb-3">Pengaturan</h5>
                <p class="card-text text-muted mb-4">Konfigurasi sistem dan platform</p>
                <a href="#" class="btn btn-modern w-100" style="background: var(--secondary-gradient); color: white;">
                    <i class="fas fa-sliders-h me-2"></i>Pengaturan
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
                    <i class="fas fa-clock me-2 text-warning"></i>Aktivitas Terbaru
                </h4>
                <a href="#" class="btn btn-outline-primary btn-sm">
                    Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="activity-list">
                <div class="activity-item d-flex align-items-start mb-3 pb-3 border-bottom">
                    <div class="activity-icon me-3 mt-1">
                        <i class="fas fa-user-plus text-success fa-lg"></i>
                    </div>
                    <div class="flex-grow-1">
                        <p class="mb-1 fw-semibold">User baru terdaftar</p>
                        <small class="text-muted">Ahmad Rahman mendaftar sebagai Desainer • 2 jam yang lalu</small>
                    </div>
                    <button class="btn btn-outline-success btn-sm">Lihat Profil</button>
                </div>
                <div class="activity-item d-flex align-items-start mb-3 pb-3 border-bottom">
                    <div class="activity-icon me-3 mt-1">
                        <i class="fas fa-palette text-primary fa-lg"></i>
                    </div>
                    <div class="flex-grow-1">
                        <p class="mb-1 fw-semibold">Jasa baru menunggu approval</p>
                        <small class="text-muted">Logo Design oleh Sari Dewi • 4 jam yang lalu</small>
                    </div>
                    <div>
                        <button class="btn btn-success btn-sm me-2">Approve</button>
                        <button class="btn btn-outline-danger btn-sm">Reject</button>
                    </div>
                </div>
                <div class="activity-item d-flex align-items-start mb-3 pb-3 border-bottom">
                    <div class="activity-icon me-3 mt-1">
                        <i class="fas fa-shopping-cart text-warning fa-lg"></i>
                    </div>
                    <div class="flex-grow-1">
                        <p class="mb-1 fw-semibold">Pesanan baru dibuat</p>
                        <small class="text-muted">UI/UX Design - Rp 500.000 • 6 jam yang lalu</small>
                    </div>
                    <button class="btn btn-outline-primary btn-sm">Lihat Detail</button>
                </div>
                <div class="activity-item d-flex align-items-start">
                    <div class="activity-icon me-3 mt-1">
                        <i class="fas fa-flag text-danger fa-lg"></i>
                    </div>
                    <div class="flex-grow-1">
                        <p class="mb-1 fw-semibold">Laporan baru</p>
                        <small class="text-muted">Keluhan tentang jasa desain • 1 hari yang lalu</small>
                    </div>
                    <button class="btn btn-outline-danger btn-sm">Tindak Lanjuti</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card-modern p-4 mb-4">
            <h5 class="fw-bold mb-3">
                <i class="fas fa-chart-pie me-2 text-info"></i>Statistik Platform
            </h5>
            <div class="stats-grid">
                <div class="stat-item text-center p-3 mb-3 bg-light rounded-3">
                    <div class="stat-number display-6 fw-bold text-primary">1,247</div>
                    <div class="stat-label small text-muted">Total User</div>
                </div>
                <div class="stat-item text-center p-3 mb-3 bg-light rounded-3">
                    <div class="stat-number display-6 fw-bold text-success">387</div>
                    <div class="stat-label small text-muted">Desainer Aktif</div>
                </div>
                <div class="stat-item text-center p-3 mb-3 bg-light rounded-3">
                    <div class="stat-number display-6 fw-bold text-warning">892</div>
                    <div class="stat-label small text-muted">Jasa Tersedia</div>
                </div>
                <div class="stat-item text-center p-3 bg-light rounded-3">
                    <div class="stat-number display-6 fw-bold text-info">2,156</div>
                    <div class="stat-label small text-muted">Total Pesanan</div>
                </div>
            </div>
        </div>

        <div class="card-modern p-4">
            <h5 class="fw-bold mb-3">
                <i class="fas fa-exclamation-triangle me-2 text-warning"></i>Perlu Perhatian
            </h5>
            <div class="alert-list">
                <div class="alert-item p-3 mb-3 bg-light-warning rounded-3 border-start border-warning border-4">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-clock text-warning me-3 mt-1"></i>
                        <div class="flex-grow-1">
                            <p class="mb-1 fw-semibold text-warning">5 Jasa Menunggu Approval</p>
                            <small class="text-muted">Perlu ditinjau dalam 24 jam</small>
                        </div>
                    </div>
                </div>
                <div class="alert-item p-3 mb-3 bg-light-danger rounded-3 border-start border-danger border-4">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-flag text-danger me-3 mt-1"></i>
                        <div class="flex-grow-1">
                            <p class="mb-1 fw-semibold text-danger">3 Laporan User</p>
                            <small class="text-muted">Perlu tindak lanjuti segera</small>
                        </div>
                    </div>
                </div>
                <div class="alert-item p-3 bg-light-info rounded-3 border-start border-info border-4">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-user-slash text-info me-3 mt-1"></i>
                        <div class="flex-grow-1">
                            <p class="mb-1 fw-semibold text-info">12 User Belum Verifikasi</p>
                            <small class="text-muted">Kirim reminder verifikasi</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="card-modern p-4">
            <h5 class="fw-bold mb-3">
                <i class="fas fa-calendar-alt me-2 text-success"></i>Pendapatan Bulan Ini
            </h5>
            <div class="revenue-chart-placeholder text-center p-4">
                <i class="fas fa-chart-line fa-4x text-muted mb-3"></i>
                <h4 class="text-success fw-bold">Rp 45.2M</h4>
                <p class="text-muted mb-0">+12% dari bulan lalu</p>
                <div class="progress mt-3" style="height: 8px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card-modern p-4">
            <h5 class="fw-bold mb-3">
                <i class="fas fa-star me-2 text-warning"></i>Rating Rata-rata Platform
            </h5>
            <div class="rating-overview text-center p-4">
                <div class="rating-display mb-3">
                    <span class="display-4 fw-bold text-warning">4.7</span>
                    <div class="rating-stars mb-2">
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star-half-alt text-warning"></i>
                    </div>
                    <small class="text-muted">Berdasarkan 1,247 ulasan</small>
                </div>
                <div class="rating-breakdown">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="small">5 stars</span>
                        <div class="progress flex-grow-1 mx-3" style="height: 6px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 68%"></div>
                        </div>
                        <span class="small">68%</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="small">4 stars</span>
                        <div class="progress flex-grow-1 mx-3" style="height: 6px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 24%"></div>
                        </div>
                        <span class="small">24%</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="small">3 stars</span>
                        <div class="progress flex-grow-1 mx-3" style="height: 6px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 6%"></div>
                        </div>
                        <span class="small">6%</span>
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

.activity-item, .stat-item, .alert-item {
    transition: all 0.3s ease;
}

.activity-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.stat-number {
    font-size: 2rem;
    line-height: 1;
}

.activity-icon {
    min-width: 30px;
}

.bg-light-warning {
    background-color: rgba(255, 193, 7, 0.1) !important;
}

.bg-light-danger {
    background-color: rgba(220, 53, 69, 0.1) !important;
}

.bg-light-info {
    background-color: rgba(13, 202, 240, 0.1) !important;
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
