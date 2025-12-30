<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class AdminController extends Controller
{
    public function dashboard(){
        $services = Service::where('status','pending')->get();
        return view('admin.dashboard',compact('services'));
    }

    public function approve($id){
        Service::find($id)->update(['status'=>'approved']);
        return back();
    }

    public function reject($id){
        Service::find($id)->update(['status'=>'rejected']);
        return back();
    }
}
