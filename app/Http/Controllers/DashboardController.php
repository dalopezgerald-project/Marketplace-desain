<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;

        if ($role === 'admin') {
            return view('dashboard.admin');
        } elseif ($role === 'desainer') {
            return view('dashboard.desainer');
        }

        return view('dashboard.user');
    }
}
