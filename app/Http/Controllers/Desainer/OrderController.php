<?php

namespace App\Http\Controllers\Desainer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store($id)
    {
        Order::create([
            'user_id' => Auth::id(),
            'service_id' => $id,
            'status' => 'menunggu'
        ]);

        return back()->with('success', 'Order berhasil dibuat');
    }

    public function desainerOrders()
    {
        $orders = Order::whereHas('service', function ($q) {
            $q->where('designer_id', Auth::id());
        })->get();

        return view('Desainer.order.index', compact('orders'));
    }

    public function updateStatus($id, $status)
    {
        $order = Order::findOrFail($id);
        $order->status = $status;
        $order->save();

        return back();
    }
}
