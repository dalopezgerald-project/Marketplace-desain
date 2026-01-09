@extends('layouts.app')

@section('title', 'Admin Dashboard - DesignHub')

@section('content')
<div class="row mb-4">
    <div class="col-md-12 d-flex justify-content-between align-items-center">
        <h2 class="mb-0">Admin Dashboard</h2>
        <div>
            <a href="{{ route('admin.services') }}" class="btn btn-outline-secondary me-2">Manage Services</a>
            <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary me-2">Manage Users</a>
            <a href="{{ route('admin.orders') }}" class="btn btn-primary">Orders</a>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-3">
        <div class="card-modern p-4 text-center">
            <h6 class="text-muted">Total Users</h6>
            <h2 class="mt-2">{{ $totalUsers ?? 0 }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-modern p-4 text-center">
            <h6 class="text-muted">Total Orders</h6>
            <h2 class="mt-2">{{ $totalOrders ?? 0 }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-modern p-4 text-center">
            <h6 class="text-muted">Approved Services</h6>
            <h2 class="mt-2">{{ $approvedServices->count() ?? 0 }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-modern p-4 text-center">
            <h6 class="text-muted">Pending Services</h6>
            <h2 class="mt-2 text-warning">{{ $pendingServices->count() ?? 0 }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-modern p-4 text-center">
            <h6 class="text-muted">Pending Updates</h6>
            <h2 class="mt-2 text-info">{{ $pendingUpdates->count() ?? 0 }}</h2>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card-modern p-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Recent Pending Services</h5>
                <small class="text-muted">Latest submissions by desainer</small>
            </div>

            @if($pendingServices->isEmpty())
                <div class="p-4 text-center text-muted">Tidak ada layanan yang menunggu persetujuan.</div>
            @else
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Designer</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingServices as $s)
                                <tr>
                                    <td>{{ $s->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($s->image)
                                                <img src="{{ asset('storage/' . $s->image) }}" alt="{{ $s->title }}" class="rounded me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded me-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                    <i class="fas fa-image text-muted"></i>
                                                </div>
                                            @endif
                                            <span>{{ Str::limit($s->title, 30) }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $s->designer->name ?? '—' }}</td>
                                    <td>Rp {{ number_format($s->price,0,',','.') }}</td>
                                    <td><span class="badge bg-warning text-dark">{{ ucfirst($s->status) }}</span></td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.services.approve', $s->id) }}" class="d-inline">
                                            @csrf
                                            <button class="btn btn-sm btn-success me-1">Approve</button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.services.reject', $s->id) }}" class="d-inline">
                                            @csrf
                                            <button class="btn btn-sm btn-danger">Reject</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card-modern p-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">
                    <i class="fas fa-edit me-2"></i>Pending Service Updates
                </h5>
                <small class="text-muted">Update requests from desainer</small>
            </div>

            @if($pendingUpdates->isEmpty())
                <div class="p-4 text-center text-muted">Tidak ada update yang menunggu persetujuan.</div>
            @else
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Designer</th>
                                <th>Current Price</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingUpdates as $s)
                                <tr>
                                    <td>{{ $s->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($s->image)
                                                <img src="{{ asset('storage/' . $s->image) }}" alt="{{ $s->title }}" class="rounded me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded me-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                    <i class="fas fa-image text-muted"></i>
                                                </div>
                                            @endif
                                            <span>{{ Str::limit($s->title, 30) }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $s->designer->name ?? '—' }}</td>
                                    <td>Rp {{ number_format($s->price,0,',','.') }}</td>
                                    <td><span class="badge bg-info">Update Pending</span></td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.services.approve-update', $s->id) }}" class="d-inline">
                                            @csrf
                                            <button class="btn btn-sm btn-success me-1">Approve Update</button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.services.reject-update', $s->id) }}" class="d-inline">
                                            @csrf
                                            <button class="btn btn-sm btn-warning">Reject Update</button>
                                        </form>
                                    </td>
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
