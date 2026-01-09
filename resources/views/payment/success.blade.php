@extends('layouts.app')

@section('title', 'Pembayaran Berhasil')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-modern text-center">
                <div class="card-body py-5">
                    <div class="mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                    </div>
                    <h2 class="mb-3">Pembayaran Berhasil!</h2>
                    <p class="text-muted mb-4">Pesanan Anda telah berhasil diproses. Desainer akan segera memulai pekerjaan.</p>

                    <div class="alert alert-info">
                        <h6 class="mb-3">Detail Pembayaran:</h6>
                        <div class="d-flex justify-content-between mb-2">
                            <span>No. Order:</span>
                            <strong>#{{ $order->id }}</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Jasa:</span>
                            <strong>{{ $order->service->title }}</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Metode Pembayaran:</span>
                            <strong>{{ ucfirst($transaction['payment_method']) }}</strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Jumlah Pembayaran:</span>
                            <strong>Rp {{ number_format($transaction['amount'] * 1.1, 0, ',', '.') }}</strong>
                        </div>
                    </div>

                    <a href="{{ route('user.order-history') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-history me-2"></i>Lihat Pesanan Saya
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card-modern {
        border: none;
        border-radius: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        margin-bottom: 2rem;
    }
</style>
@endsection
