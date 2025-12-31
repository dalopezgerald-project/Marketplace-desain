@extends('layouts.app')

@section('content')

<h4 class="mb-4 fw-bold animate__animated animate__fadeIn">
    Dashboard Desainer
</h4>

<a href="/desainer/service/create" 
   class="btn btn-primary mb-4 animate__animated animate__fadeInUp">
   + Tambah Jasa
</a>

<div class="row">
@forelse($services as $s)
<div class="col-md-4">
    <div class="card mb-4 animate__animated animate__fadeInUp">
        <div class="card-body">
            <h5 class="fw-bold">{{ $s->title }}</h5>
            <p class="text-muted">{{ Str::limit($s->description, 80) }}</p>

            <p>
                <strong>Rp {{ number_format($s->price) }}</strong>
            </p>

            <span class="badge 
                {{ $s->status == 'approved' ? 'bg-success' : 
                   ($s->status == 'pending' ? 'bg-warning' : 'bg-danger') }}">
                {{ ucfirst($s->status) }}
            </span>
        </div>
    </div>
</div>
@empty
<p class="text-muted">Belum ada jasa.</p>
@endforelse
</div>

@endsection
