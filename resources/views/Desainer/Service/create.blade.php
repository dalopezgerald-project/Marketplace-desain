@extends('layouts.app')

@section('title', 'Tambah Jasa Baru - Dashboard Desainer')

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
                        <a class="nav-link" href="{{ route('desainer.services.index') }}">
                            <i class="fas fa-palette me-2"></i>Jasa Saya
                        </a>
                        <a class="nav-link" href="{{ route('desainer.orders.index') }}">
                            <i class="fas fa-shopping-cart me-2"></i>Order Masuk
                        </a>
                        <a class="nav-link active" href="{{ route('desainer.services.create') }}">
                            <i class="fas fa-plus me-2"></i>Tambah Jasa
                        </a>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10">
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('desainer.services.index') }}" class="btn btn-outline-secondary me-3">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
                <h2 class="mb-0">
                    <i class="fas fa-plus me-2"></i>Tambah Jasa Baru
                </h2>
            </div>

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Terjadi kesalahan:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-lg-8">
                    <div class="card card-modern">
                        <div class="card-header">
                            <h5 class="mb-0">Informasi Jasa</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('desainer.services.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <label for="title" class="form-label fw-bold">
                                            <i class="fas fa-heading me-2 text-primary"></i>Judul Jasa
                                        </label>
                                        <input type="text" name="title" id="title" class="form-control form-control-lg"
                                               placeholder="Contoh: Logo Design Modern untuk Startup"
                                               value="{{ old('title') }}" required>
                                        <div class="form-text">Judul yang menarik akan lebih mudah ditemukan klien</div>
                                    </div>

                                    <div class="col-md-12 mb-4">
                                        <label for="description" class="form-label fw-bold">
                                            <i class="fas fa-align-left me-2 text-primary"></i>Deskripsi Jasa
                                        </label>
                                        <textarea name="description" id="description" class="form-control" rows="4"
                                                  placeholder="Jelaskan detail jasa Anda, portofolio, dan hal lain yang perlu diketahui klien..."
                                                  required></textarea>
                                        <div class="form-text">Deskripsi yang detail akan membantu klien memahami jasa Anda</div>
                                    </div>

                                    <div class="col-md-12 mb-4">
                                        <label for="image" class="form-label fw-bold">
                                            <i class="fas fa-image me-2 text-primary"></i>Poster Jasa
                                        </label>
                                        <input type="file" name="image" id="image" class="form-control"
                                               accept="image/*">
                                        <div class="form-text">
                                            Upload gambar poster jasa Anda (JPEG, PNG, JPG, GIF - Max 2MB).
                                            Poster yang menarik akan lebih mudah menarik perhatian klien.
                                        </div>
                                        <div id="image-preview" class="mt-3" style="display: none;">
                                            <img id="preview-img" src="" alt="Preview" class="img-fluid rounded" style="max-height: 200px;">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="price" class="form-label fw-bold">
                                            <i class="fas fa-money-bill-wave me-2 text-primary"></i>Harga (Rp)
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="text" name="price" id="price" class="form-control form-control-lg"
                                                   placeholder="50000" value="{{ old('price') }}" required>
                                        </div>
                                        <div class="form-text">Harga minimal Rp 10.000</div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label class="form-label fw-bold">
                                            <i class="fas fa-info-circle me-2 text-primary"></i>Status Awal
                                        </label>
                                        <div class="alert alert-info">
                                            <i class="fas fa-info-circle me-2"></i>
                                            Jasa baru akan berstatus <strong>"Menunggu"</strong> dan perlu disetujui admin terlebih dahulu.
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <hr class="my-4">
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('desainer.services.index') }}" class="btn btn-outline-secondary">
                                                <i class="fas fa-times me-2"></i>Batal
                                            </a>
                                            <button type="submit" class="btn btn-primary btn-lg">
                                                <i class="fas fa-save me-2"></i>Simpan & Ajukan Persetujuan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                        <div class="col-lg-4">
                    <div class="card card-modern">
                        <div class="card-header">
                            <h6 class="mb-0">
                                <i class="fas fa-lightbulb me-2"></i>Tips Sukses
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="tips-list">
                                <div class="tip-item mb-3">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Gunakan kata kunci</strong> yang sering dicari klien
                                </div>
                                <div class="tip-item mb-3">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Harga kompetitif</strong> tapi sesuai kualitas
                                </div>
                                <div class="tip-item mb-3">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Portofolio</strong> lampirkan dalam deskripsi
                                </div>
                                <div class="tip-item mb-3">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Responsif</strong> terhadap pesanan masuk
                                </div>
                                <div class="tip-item">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Revisi</strong> maksimal 3x tanpa biaya tambahan
                                </div>
                            </div>
                        </div>
                    </div>

                        <div class="card card-modern mt-3">
                        <div class="card-header">
                            <h6 class="mb-0">
                                <i class="fas fa-chart-line me-2"></i>Statistik Anda
                            </h6>
                        </div>
                        <div class="card-body text-center">
                                @php
                                    use App\Models\Order;
                                    $activeServices = auth()->user()->services()->where('status','approved')->count();
                                    $completedOrders = Order::whereHas('service', function($q) { $q->where('designer_id', auth()->id()); })->where('status', 'selesai')->count();
                                @endphp

                                <div class="row">
                                    <div class="col-6">
                                        <div class="h4 text-primary mb-0">{{ $activeServices }}</div>
                                        <small class="text-muted">Jasa Aktif</small>
                                    </div>
                                    <div class="col-6">
                                        <div class="h4 text-success mb-0">{{ $completedOrders }}</div>
                                        <small class="text-muted">Selesai</small>
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
.sidebar-desainer {
    min-height: calc(100vh - 76px);
    border-radius: 0;
    border-right: 1px solid rgba(0,0,0,0.1);
    background: linear-gradient(135deg, #f8f9ff 0%, #e8f2ff 100%);
}

.sidebar-desainer .nav-link {
    color: #6c757d;
    padding: 0.75rem 1rem;
    border-radius: 8px;
    margin-bottom: 0.25rem;
    transition: all 0.3s ease;
}

.sidebar-desainer .nav-link:hover,
.sidebar-desainer .nav-link.active {
    background: var(--primary-gradient);
    color: white !important;
}

.card-modern {
    border: none;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.card-modern:hover {
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
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

.tips-list .tip-item {
    font-size: 0.9rem;
    line-height: 1.4;
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
// Auto-format price input
document.getElementById('price').addEventListener('input', function(e) {
    let value = e.target.value.replace(/[^0-9]/g, '');
    if (value) {
        e.target.value = parseInt(value).toLocaleString('id-ID');
    }
});

// Character counter for description
document.getElementById('description').addEventListener('input', function() {
    const maxLength = 1000;
    const currentLength = this.value.length;

    if (currentLength > maxLength) {
        this.value = this.value.substring(0, maxLength);
    }
});

// Image preview
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('image-preview');
    const previewImg = document.getElementById('preview-img');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
    }
});
</script>
@endsection
