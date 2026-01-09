@extends('layouts.app')

@section('title', 'Edit Jasa - Admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-lg-2 px-0">
            <div class="card-modern sidebar-admin">
                <div class="card-body p-4">
                    <h5 class="mb-4"><i class="fas fa-cog me-2"></i>Admin Panel</h5>
                    <nav class="nav flex-column">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <a class="nav-link active" href="{{ route('admin.services') }}">Kelola Jasa</a>
                        <a class="nav-link" href="{{ route('admin.users') }}">Kelola User</a>
                        <a class="nav-link" href="{{ route('admin.orders') }}">Kelola Order</a>
                    </nav>
                </div>
            </div>
        </div>

        <div class="col-md-9 col-lg-10">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Jasa</h2>
                <a href="{{ route('admin.services') }}" class="btn btn-outline-secondary">Kembali</a>
            </div>

            <div class="card card-modern">
                <div class="card-body">
                    <form action="{{ route('admin.services.update', $service->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Pilih Desainer</label>
                            <select name="designer_id" class="form-select" required>
                                @foreach($designers as $d)
                                    <option value="{{ $d->id }}" {{ $service->designer_id == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input name="title" class="form-control" value="{{ old('title', $service->title) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="description" class="form-control" rows="5" required>{{ old('description', $service->description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Harga (Rp)</label>
                            <input name="price" type="number" class="form-control" min="0" value="{{ old('price', $service->price) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="pending" {{ $service->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ $service->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ $service->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.services') }}" class="btn btn-outline-secondary me-2">Batal</a>
                            <button class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
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
