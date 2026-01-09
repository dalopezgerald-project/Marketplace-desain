<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function checkout($orderId)
    {
        $order = Order::with('service')
            ->where('id', $orderId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('payment.checkout', compact('order'));
    }

    public function process(Request $request, $orderId)
    {
        $order = Order::with('service')
            ->where('id', $orderId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Validasi input
        $validated = $request->validate([
            'payment_method' => 'required|in:transfer,card,ewallet'
        ]);

        try {
            // Integrasi dengan Midtrans (simulated)
            $response = $this->createMidtransTransaction($order, $validated['payment_method']);

            // Simpan payment info
            $order->update([
                'payment_status' => 'pending',
                'payment_method' => $validated['payment_method'],
                'transaction_id' => $response['transaction_id'] ?? null
            ]);

            return view('payment.success', [
                'order' => $order,
                'transaction' => $response
            ]);

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
        }
    }

    private function createMidtransTransaction($order, $method)
    {
        // Simulasi Midtrans API Integration
        // Dalam production, gunakan library resmi Midtrans
        // https://github.com/midtrans/midtrans-php

        $transactionId = 'TRX-' . time() . '-' . $order->id;

        // Simulasi response dari Midtrans
        return [
            'transaction_id' => $transactionId,
            'status' => 'pending',
            'amount' => $order->service->price,
            'payment_method' => $method,
            'created_at' => now(),
            'snap_url' => 'https://app.midtrans.com/snap/snap.js' // Dummy URL
        ];
    }

    public function verify(Request $request)
    {
        // Verifikasi callback dari Midtrans
        // Dalam production, validate signature dari Midtrans

        $transactionId = $request->transaction_id;
        $status = $request->status;

        $order = Order::where('transaction_id', $transactionId)->first();

        if ($order) {
            if ($status === 'settlement' || $status === 'capture') {
                $order->update([
                    'payment_status' => 'paid',
                    'status' => 'diproses'
                ]);
            } elseif ($status === 'cancel' || $status === 'deny') {
                $order->update([
                    'payment_status' => 'failed'
                ]);
            }
        }

        return response()->json(['status' => 'ok']);
    }
}
