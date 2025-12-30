<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth','role:desainer'])->group(function(){
    Route::get('/desainer/service',[ServiceController::class,'index']);
    Route::get('/desainer/service/create',[ServiceController::class,'create']);
    Route::post('/desainer/service',[ServiceController::class,'store']);
});

Route::middleware(['auth','role:admin'])->group(function(){
    Route::get('/admin/dashboard',[AdminController::class,'dashboard']);
    Route::post('/admin/service/{id}/approve',[AdminController::class,'approve']);
    Route::post('/admin/service/{id}/reject',[AdminController::class,'reject']);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

