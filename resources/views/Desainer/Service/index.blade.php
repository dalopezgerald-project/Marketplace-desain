@extends('layouts.app')

@section('content')

<h4>Jasa Desain Saya</h4>

<a href="/desainer/service/create" class="btn btn-primary mb-3">
    + Tambah Jasa
</a>

<table class="table table-bordered">
    <tr class="table-dark">
        <th>Judul</th>
        <th>Harga</th>
        <th>Status</th>
    </tr>

    @forelse($services as $s)
    <tr>
        <td>{{ $s->title }}</td>
        <td>Rp {{ number_format($s->price) }}</td>
        <td>
            @if($s->status == 'pending')
                <span class="badge bg-warning">Pending</span>
            @elseif($s->status == 'approved')
                <span class="badge bg-success">Approved</span>
            @else
                <span class="badge bg-danger">Rejected</span>
            @endif
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="3" class="text-center">Belum ada jasa</td>
    </tr>
    @endforelse
</table>

@endsection
