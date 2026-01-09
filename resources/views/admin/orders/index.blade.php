@extends('layouts.app')

@section('title', 'Kelola Order - Admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-lg-2 px-0">
            <div class="card-modern sidebar-admin">
                <div class="card-body p-4">
                    <h5 class="mb-4"><i class="fas fa-cog me-2"></i>Admin Panel</h5>
                    <nav class="nav flex-column">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <a class="nav-link" href="{{ route('admin.services') }}">Kelola Jasa</a>
                        <a class="nav-link" href="{{ route('admin.users') }}">Kelola User</a>
                        <a class="nav-link active" href="{{ route('admin.orders') }}">Kelola Order</a>
                    </nav>
                </div>
            </div>
        </div>

        <div class="col-md-9 col-lg-10">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0"><i class="fas fa-shopping-cart me-2"></i>Kelola Order</h2>
            </div>

            <div class="card card-modern">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Service</th>
                                    <th>Pemesan</th>
                                    <th>Desainer</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                    <th>Dibuat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $o)
                                <tr>
                                    <td>{{ $o->id }}</td>
                                    <td>{{ $o->service->title ?? '-' }}</td>
                                    <td>{{ $o->user->name ?? '-' }}</td>
                                    <td>{{ $o->service->designer->name ?? '-' }}</td>
                                    <td>Rp {{ number_format($o->price ?? ($o->service->price ?? 0),0,',','.') }}</td>
                                    <td>{{ ucfirst($o->status) }}</td>
                                    <td>{{ $o->created_at->format('d M Y') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">Belum ada order</td>
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
.sidebar-admin { min-height: calc(100vh - 76px); }
.card-modern { border-radius: 12px; }
</style>

@endsection
