<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class UserController extends Controller
{
    /**
     * Menampilkan jasa desain yang sudah di-approve admin
     */
    public function index()
    {
        $services = Service::where('status', 'approved')->get();
        return view('user.services', compact('services'));
    }
}
