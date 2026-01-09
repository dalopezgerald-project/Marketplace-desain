@extends('layouts.app')

@section('title', 'Kelola User - Admin Dashboard')

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
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">
                    <i class="fas fa-users me-2"></i>Kelola User
                </h2>
                <a href="{{ route('admin.users.create') }}" class="btn btn-modern btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah User
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card card-modern">
                <div class="card-header">
                    <h5 class="mb-0">Daftar Semua User</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Bergabung</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>
                                        <strong>{{ $user->name }}</strong>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>{!! $user->role_badge !!}</td>
                                    <td>{{ $user->created_at->format('d M Y') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                               class="btn btn-sm btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @if(!$user->isAdmin())
                                            <form action="{{ route('admin.users.destroy', $user->id) }}"
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Yakin hapus user ini?')"
                                                        title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">Belum ada user</h5>
                                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus me-2"></i>Buat User Pertama
                                        </a>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
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
    background: var(--primary-gradient);
    color: white !important;
}

.card-modern {
    transition: all 0.3s ease;
}

.card-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}
</style>
@endsection
