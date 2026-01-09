@extends('layouts.app')

@section('title', 'Tambah Jasa - Admin')

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
                <h2 class="mb-0"><i class="fas fa-plus me-2"></i>Tambah Jasa</h2>
                <a href="{{ route('admin.services') }}" class="btn btn-outline-secondary">Kembali</a>
            </div>

            <div class="card card-modern">
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.services.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Pilih Desainer</label>
                            <select name="designer_id" class="form-select" required>
                                <option value="">-- Pilih Desainer --</option>
                                @foreach($designers as $d)
                                    <option value="{{ $d->id }}">{{ $d->name }} ({{ $d->email }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input name="title" class="form-control" value="{{ old('title') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="description" class="form-control" rows="5" required>{{ old('description') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Harga (Rp)</label>
                            <input name="price" type="number" class="form-control" min="0" value="{{ old('price') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="approved">Approved</option>
                                <option value="pending" selected>Pending</option>
                                <option value="rejected">Rejected</option>
                            </select>
                            <div class="form-text">Pilih status layanan (biasanya <strong>Pending</strong> untuk pengajuan oleh admin).</div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.services') }}" class="btn btn-outline-secondary me-2">Batal</a>
                            <button class="btn btn-primary">Simpan</button>
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
