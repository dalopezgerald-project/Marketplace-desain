@extends('layouts.app')

@section('title', 'Kelola Jasa - Admin')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3 col-lg-2 px-0">
			<div class="card-modern sidebar-admin">
				<div class="card-body p-4">
					<h5 class="mb-4">
						<i class="fas fa-cog me-2"></i>Admin Panel
					</h5>
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
				<h2 class="mb-0"><i class="fas fa-palette me-2"></i>Kelola Jasa</h2>
				<a href="{{ route('admin.services.create') }}" class="btn btn-modern btn-primary">
					<i class="fas fa-plus me-2"></i>Tambahkan Jasa
				</a>
			</div>

			@if(session('success'))
				<div class="alert alert-success">{{ session('success') }}</div>
			@endif

			<div class="card card-modern">
				<div class="card-header">
					<h5 class="mb-0">Daftar Layanan</h5>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-hover align-middle">
							<thead class="table-light">
								<tr>
									<th>ID</th>
									<th>Judul</th>
									<th>Desainer</th>
									<th>Harga</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								@forelse($services as $s)
								<tr>
									<td>{{ $s->id }}</td>
									<td>{{ $s->title }}</td>
									<td>{{ $s->designer->name ?? '-' }}</td>
									<td>Rp {{ number_format($s->price,0,',','.') }}</td>
									<td>
										<span class="badge ">
											{{ ucfirst($s->status) }}
										</span>
									</td>
									<td>
										<div class="btn-group" role="group">
											<a href="{{ route('admin.services.edit', $s->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
											@if($s->status !== 'approved')
												<form action="{{ route('admin.services.approve', $s->id) }}" method="POST" class="d-inline">
													@csrf
													<button class="btn btn-sm btn-success">Approve</button>
												</form>
											@endif

											@if($s->status !== 'rejected')
												<form action="{{ route('admin.services.reject', $s->id) }}" method="POST" class="d-inline">
													@csrf
													<button class="btn btn-sm btn-danger">Reject</button>
												</form>
											@endif

											<form action="{{ route('admin.services.destroy', $s->id) }}" method="POST" class="d-inline">
												@csrf
												@method('DELETE')
												<button class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus jasa ini?')">Hapus</button>
											</form>
										</div>
									</td>
								</tr>
								@empty
								<tr>
									<td colspan="6" class="text-center py-4">Belum ada layanan</td>
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
.sidebar-admin { min-height: calc(100vh - 76px); border-radius: 0; border-right: 1px solid rgba(0,0,0,0.06); }
.card-modern { border-radius: 12px; }
</style>

@endsection

