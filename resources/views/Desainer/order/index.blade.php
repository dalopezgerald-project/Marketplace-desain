@extends('layouts.app')

@section('content')

<h4>Order Masuk</h4>

<table class="table table-bordered">
<tr class="table-dark">
<th>User</th><th>Jasa</th><th>Status</th><th>Aksi</th>
</tr>

@foreach($orders as $o)
<tr>
<td>{{ $o->user->name }}</td>
<td>{{ $o->service->title }}</td>
<td>{{ $o->status }}</td>
<td>
<form method="POST" action="/order/{{ $o->id }}/diproses" class="d-inline">
@csrf
<button class="btn btn-warning btn-sm">Proses</button>
</form>

<form method="POST" action="/order/{{ $o->id }}/selesai" class="d-inline">
@csrf
<button class="btn btn-success btn-sm">Selesai</button>
</form>
</td>
</tr>
@endforeach
</table>

@endsection
