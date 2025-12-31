@extends('layouts.app')

@section('content')
<div class="row justify-content-center animate__animated animate__fadeInDown">
    <div class="col-md-5">
        <div class="card shadow-lg border-0">
            <div class="card-body p-4">
                <h3 class="text-center mb-4 fw-bold">Login</h3>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror"
                               name="email" required autofocus>
                        @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" 
                               class="form-control @error('password') is-invalid @enderror"
                               name="password" required>
                        @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <button class="btn btn-dark w-100 mt-3">
                        Login
                    </button>
                </form>

                <p class="text-center mt-3 text-muted">
                    Belum punya akun? <a href="{{ route('register') }}">Register</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
