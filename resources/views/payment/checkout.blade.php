@extends('layouts.app')

@section('title', 'Checkout Order')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card card-modern">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-shopping-cart me-2"></i>Detail Pembayaran
                    </h5>
                </div>
                <div class="card-body">
                    <h6 class="mb-3">Jasa yang Dipesan:</h6>
                    <div class="border rounded p-3 mb-4">
                        <h5>{{ $order->service->title }}</h5>
                        <p class="text-muted">{{ Str::limit($order->service->description, 150) }}</p>
                        <p class="mb-0"><strong>Harga: Rp {{ number_format($order->service->price, 0, ',', '.') }}</strong></p>
                    </div>

                    <hr>

                    <h6 class="mb-3">Metode Pembayaran:</h6>
                    <form action="{{ route('payment.process', $order->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="transfer" value="transfer" required>
                                <label class="form-check-label" for="transfer">
                                    <i class="fas fa-university me-2"></i>Transfer Bank
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="card" value="card">
                                <label class="form-check-label" for="card">
                                    <i class="fas fa-credit-card me-2"></i>Kartu Kredit/Debit
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="ewallet" value="ewallet">
                                <label class="form-check-label" for="ewallet">
                                    <i class="fas fa-wallet me-2"></i>E-Wallet (GCash, OVO, Dana)
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="fas fa-lock me-2"></i>Lanjutkan ke Pembayaran
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-modern">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>Ringkasan
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($order->service->price, 0, ',', '.') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Biaya Platform</span>
                        <span>Rp 0</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Pajak (10%)</span>
                        <span>Rp {{ number_format($order->service->price * 0.1, 0, ',', '.') }}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <strong>Total</strong>
                        <strong>Rp {{ number_format($order->service->price * 1.1, 0, ',', '.') }}</strong>
                    </div>
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
