@extends('layouts.app')

@section('title', 'Edit User - Admin Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 px-0">
            <div class="card-modern sidebar-admin">
                <div class="card-body p-4">
                    <h5 class="mb-4">
                        <i class="fas fa-cog me-2"></i>Admin Panel
                    </h5>
                    <nav class="nav flex-column">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a>
                        <a class="nav-link" href="{{ route('admin.services') }}">
                            <i class="fas fa-palette me-2"></i>Kelola Jasa
                        </a>
                        <a class="nav-link active" href="{{ route('admin.users') }}">
                            <i class="fas fa-users me-2"></i>Kelola User
                        </a>
                        <a class="nav-link" href="{{ route('admin.orders') }}">
                            <i class="fas fa-shopping-cart me-2"></i>Kelola Order
                        </a>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10">
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary me-3">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
                <h2 class="mb-0">
                    <i class="fas fa-user-edit me-2"></i>Edit User
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
                <div class="col-lg-6">
                    <div class="card card-modern">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-user-circle me-2"></i>Data User
                            </h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-4">
                                    <label for="name" class="form-label fw-bold">
                                        <i class="fas fa-user me-2 text-primary"></i>Nama Lengkap
                                    </label>
                                    <input type="text" name="name" id="name" class="form-control form-control-lg @error('name') is-invalid @enderror"
                                           value="{{ old('name', $user->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="email" class="form-label fw-bold">
                                        <i class="fas fa-envelope me-2 text-primary"></i>Email
                                    </label>
                                    <input type="email" name="email" id="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                                           value="{{ old('email', $user->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Email harus unik dan valid</small>
                                </div>

                                <div class="mb-4">
                                    <label for="role" class="form-label fw-bold">
                                        <i class="fas fa-shield-alt me-2 text-primary"></i>Role/Peran
                                    </label>
                                    <select name="role" id="role" class="form-select form-select-lg @error('role') is-invalid @enderror" required>
                                        <option value="">-- Pilih Role --</option>
                                        <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>
                                            👨‍💼 Admin (Full Access)
                                        </option>
                                        <option value="desainer" {{ old('role', $user->role) === 'desainer' ? 'selected' : '' }}>
                                            🎨 Desainer (Seller)
                                        </option>
                                        <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>
                                            👤 User (Buyer)
                                        </option>
                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="alert alert-info mb-4">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>Informasi User:</strong><br>
                                    <small>
                                        - Email: {{ $user->email }}<br>
                                        - Bergabung: {{ $user->created_at->format('d M Y H:i') }}<br>
                                        - Role Saat Ini: <span class="badge bg-primary">{{ ucfirst($user->role) }}</span>
                                    </small>
                                </div>

                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary flex-grow-1">
                                        <i class="fas fa-times me-2"></i>Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary flex-grow-1">
                                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card card-modern">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                <i class="fas fa-info-circle me-2 text-info"></i>Penjelasan Role
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-4">
                                <h6 class="text-primary mb-2">👨‍💼 Admin</h6>
                                <p class="text-muted small mb-3">
                                    Memiliki akses penuh ke sistem:
                                    <ul class="small mt-2">
                                        <li>Mengelola semua user</li>
                                        <li>Menyetujui/menolak jasa baru</li>
                                        <li>Menyetujui/menolak update jasa</li>
                                        <li>Melihat semua order dan pesanan</li>
                                        <li>Berkomunikasi dengan semua user</li>
                                    </ul>
                                </p>
                            </div>

                            <hr>

                            <div class="mb-4">
                                <h6 class="text-success mb-2">🎨 Desainer</h6>
                                <p class="text-muted small mb-3">
                                    Menjual jasa desain di marketplace:
                                    <ul class="small mt-2">
                                        <li>Membuat dan mengelola jasa/portofolio</li>
                                        <li>Menerima pesanan dari user</li>
                                        <li>Mengupdate status pesanan</li>
                                        <li>Update jasa dengan persetujuan admin</li>
                                        <li>Chat dengan admin dan user</li>
                                    </ul>
                                </p>
                            </div>

                            <hr>

                            <div class="mb-4">
                                <h6 class="text-warning mb-2">👤 User</h6>
                                <p class="text-muted small mb-3">
                                    Membeli jasa dari desainer:
                                    <ul class="small mt-2">
                                        <li>Melihat daftar jasa/portofolio</li>
                                        <li>Memesan jasa dari desainer</li>
                                        <li>Melihat riwayat pesanan</li>
                                        <li>Melacak status pesanan</li>
                                        <li>Chat dengan desainer dan admin</li>
                                    </ul>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .sidebar-admin {
        min-height: calc(100vh - 76px);
        border-radius: 0;
        border-right: 1px solid rgba(0,0,0,0.1);
        position: sticky;
        top: 76px;
    }

    .sidebar-admin .nav-link {
        color: #6c757d;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        margin-bottom: 0.25rem;
        transition: all 0.3s ease;
    }

    .sidebar-admin .nav-link:hover,
    .sidebar-admin .nav-link.active {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white !important;
    }

    .card-modern {
        transition: all 0.3s ease;
        border: none;
    }

    .card-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
</style>
@endsection
