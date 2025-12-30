@extends('layouts.app')

@section('content')

<h4>Persetujuan Jasa Desain</h4>

<table class="table table-bordered">
    <tr class="table-dark">
        <th>Judul</th>
        <th>Desainer</th>
        <th>Aksi</th>
    </tr>

    @forelse($services as $s)
    <tr>
        <td>{{ $s->title }}</td>
        <td>{{ $s->designer->name ?? '-' }}</td>
        <td class="d-flex gap-2">
            <form method="POST" action="/admin/service/{{ $s->id }}/approve">
                @csrf
                <button class="btn btn-success btn-sm">Approve</button>
            </form>

            <form method="POST" action="/admin/service/{{ $s->id }}/reject">
                @csrf
                <button class="btn btn-danger btn-sm">Reject</button>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="3" class="text-center">Tidak ada jasa pending</td>
    </tr>
    @endforelse
</table>

@endsection
