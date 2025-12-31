@extends('layouts.app')

@section('content')

<h4 class="mb-4 fw-bold animate__animated animate__fadeIn">
    Dashboard Admin – Persetujuan Jasa
</h4>

<div class="card shadow animate__animated animate__fadeInUp">
<div class="card-body">

<table class="table table-bordered align-middle">
<thead class="table-dark">
<tr>
    <th>Judul Jasa</th>
    <th>Desainer</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>
</thead>

<tbody>
@forelse($services as $s)
<tr>
    <td>{{ $s->title }}</td>
    <td>{{ $s->designer->name ?? '-' }}</td>
    <td>
        <span class="badge bg-warning">Pending</span>
    </td>
    <td>
        <form method="POST" action="/admin/service/{{ $s->id }}/approve" class="d-inline">
            @csrf
            <button class="btn btn-success btn-sm">Approve</button>
        </form>

        <form method="POST" action="/admin/service/{{ $s->id }}/reject" class="d-inline">
            @csrf
            <button class="btn btn-danger btn-sm">Reject</button>
        </form>
    </td>
</tr>
@empty
<tr>
    <td colspan="4" class="text-center text-muted">
        Tidak ada jasa menunggu persetujuan
    </td>
</tr>
@endforelse
</tbody>
</table>

</div>
</div>

@endsection
