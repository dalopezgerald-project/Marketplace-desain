@extends('layouts.app')

@section('title', 'Edit Jasa - Dashboard Desainer')

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
                        <a class="nav-link" href="{{ route('desainer.services.create') }}">
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
                    <i class="fas fa-edit me-2"></i>Edit Jasa
                    @if($service->status === 'approved')
                        <span class="badge bg-warning ms-2">Menunggu Approval</span>
                    @endif
                </h2>
            </div>

            @if($service->status === 'approved')
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Informasi:</strong> Jasa ini sudah disetujui admin. Perubahan yang Anda buat akan memerlukan persetujuan admin kembali sebelum dipublikasikan.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

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
                            <form action="{{ route('desainer.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <label for="title" class="form-label fw-bold">
                                            <i class="fas fa-heading me-2 text-primary"></i>Judul Jasa
                                        </label>
                                        <input type="text" name="title" id="title" class="form-control form-control-lg"
                                               placeholder="Contoh: Logo Design Modern untuk Startup"
                                               value="{{ old('title', $service->title) }}" required>
                                        <div class="form-text">Judul yang menarik akan lebih mudah ditemukan klien</div>
                                    </div>

                                    <div class="col-md-12 mb-4">
                                        <label for="description" class="form-label fw-bold">
                                            <i class="fas fa-align-left me-2 text-primary"></i>Deskripsi Lengkap
                                        </label>
                                        <textarea name="description" id="description" class="form-control" rows="6"
                                                  placeholder="Jelaskan detail jasa yang Anda tawarkan..." required>{{ old('description', $service->description) }}</textarea>
                                        <div class="form-text">Deskripsi yang detail membantu klien memahami jasa Anda</div>
                                    </div>

                                    <div class="col-md-12 mb-4">
                                        <label for="image" class="form-label fw-bold">
                                            <i class="fas fa-image me-2 text-primary"></i>Poster Jasa
                                        </label>
                                        <input type="file" name="image" id="image" class="form-control"
                                               accept="image/*">
                                        <div class="form-text">
                                            Upload gambar poster jasa Anda (JPEG, PNG, JPG, GIF - Max 2MB).
                                            Kosongkan jika tidak ingin mengubah poster.
                                        </div>
                                        <div id="image-preview" class="mt-3">
                                            @if($service->image)
                                                <img id="preview-img" src="{{ asset('storage/' . $service->image) }}" alt="Current Poster" class="img-fluid rounded" style="max-height: 200px;">
                                            @else
                                                <div class="text-muted">Belum ada poster</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="price" class="form-label fw-bold">
                                            <i class="fas fa-money-bill-wave me-2 text-primary"></i>Harga (Rp)
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="text" name="price" id="price" class="form-control form-control-lg"
                                                   placeholder="50000" value="{{ old('price', $service->price) }}" required>
                                        </div>
                                        <div class="form-text">Harga minimal Rp 10.000</div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label class="form-label fw-bold">
                                            <i class="fas fa-info-circle me-2 text-primary"></i>Status
                                        </label>
                                        <div class="alert alert-warning">
                                            <i class="fas fa-exclamation-triangle me-2"></i>
                                            Mengubah jasa akan mereset status menjadi <strong>"Menunggu"</strong> dan perlu approval ulang.
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
                                            <button type="submit" class="btn btn-warning btn-lg">
                                                <i class="fas fa-save me-2"></i>Update Jasa
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
                                <i class="fas fa-lightbulb me-2"></i>Tips Edit Jasa
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="tips-list">
                                <div class="tip-item mb-3">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Perbarui deskripsi</strong> jika ada perubahan layanan
                                </div>
                                <div class="tip-item mb-3">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Upload poster baru</strong> untuk tampilan yang lebih menarik
                                </div>
                                <div class="tip-item mb-3">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <strong>Periksa harga</strong> sesuai dengan kualitas dan kompetitor
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
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.sidebar-desainer {
    min-height: 100vh;
    border-right: 1px solid rgba(0,0,0,0.1);
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

// Image preview
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const previewImg = document.getElementById('preview-img');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endsection
