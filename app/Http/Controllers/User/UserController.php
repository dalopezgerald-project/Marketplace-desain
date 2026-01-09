<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $services = Service::where('status', 'approved')
            ->with('designer')
            ->paginate(12);
        return view('user.index', compact('services'));
    }

    public function showService($id)
    {
        $service = Service::where('status', 'approved')
            ->with('designer')
            ->findOrFail($id);
        return view('user.service-detail', compact('service'));
    }

    public function orderHistory()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('service.designer')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('user.order-history', compact('orders'));
    }

    public function placeOrder(Request $request, $serviceId)
    {
        $service = Service::where('status', 'approved')->findOrFail($serviceId);

        // Check if user already ordered this service
        $existingOrder = Order::where('user_id', Auth::id())
            ->where('service_id', $serviceId)
            ->first();

        if ($existingOrder) {
            return back()->with('error', 'Anda sudah memesan jasa ini sebelumnya');
        }

        Order::create([
            'user_id' => Auth::id(),
            'service_id' => $serviceId,
            'status' => 'menunggu'
        ]);

        return back()->with('success', 'Order berhasil dibuat! Desainer akan segera memproses pesanan Anda.');
    }

    public function cancelOrder($orderId)
    {
        $order = Order::where('user_id', Auth::id())
            ->findOrFail($orderId);

        // Only allow cancellation if status is 'menunggu' or 'diproses'
        if (!in_array($order->status, ['menunggu', 'diproses'])) {
            return back()->with('error', 'Pesanan tidak dapat dibatalkan karena sudah dalam proses atau sudah selesai.');
        }

        $order->update(['status' => 'dibatalkan']);

        return back()->with('success', 'Pesanan berhasil dibatalkan.');
    }

    public function deleteOrder($orderId)
    {
        $order = Order::where('user_id', Auth::id())
            ->findOrFail($orderId);

        // Only allow deletion if status is 'dibatalkan'
        if ($order->status !== 'dibatalkan') {
            return back()->with('error', 'Hanya pesanan yang sudah dibatalkan yang dapat dihapus dari riwayat.');
        }

        $order->delete();

        return back()->with('success', 'Riwayat pesanan berhasil dihapus.');
    }
}
