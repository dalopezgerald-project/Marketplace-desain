@extends('layouts.app')

@section('content')

<h4>Daftar Jasa Desain</h4>

<div class="row">
@foreach($services as $s)
<div class="col-md-4">
<div class="card mb-3">
    <div class="card-body">
        <h5>{{ $s->title }}</h5>
        <p>{{ $s->description }}</p>
        <p><strong>Rp {{ number_format($s->price) }}</strong></p>

        <form method="POST" action="/order/{{ $s->id }}">
            @csrf
            <button class="btn btn-primary btn-sm">Order</button>
        </form>
    </div>
</div>
</div>
@endforeach
</div>

@endsection
