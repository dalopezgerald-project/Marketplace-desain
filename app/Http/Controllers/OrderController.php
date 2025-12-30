<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Service;

class OrderController extends Controller
{
    // USER pesan jasa
    public function store($id){
        Order::create([
            'user_id' => auth()->id(),
            'service_id' => $id
        ]);
        return back()->with('success','Order berhasil dibuat');
    }

    // DESAINER lihat order masuk
    public function desainerOrders(){
        $orders = Order::whereHas('service', function($q){
            $q->where('designer_id', auth()->id());
        })->get();

        return view('desainer.order.index', compact('orders'));
    }

    // DESAINER update status
    public function updateStatus($id, $status){
        Order::find($id)->update(['status'=>$status]);
        return back();
    }
}

