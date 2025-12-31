<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth','role:user'])->group(function(){
    Route::get('/services',[UserController::class,'index']);
});

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

// USER
Route::middleware(['auth','role:user'])->group(function(){
    Route::get('/services',[UserController::class,'index']);
    Route::post('/order/{id}',[OrderController::class,'store']);
});

// DESAINER
Route::middleware(['auth','role:desainer'])->group(function(){
    Route::get('/desainer/orders',[OrderController::class,'desainerOrders']);
    Route::post('/order/{id}/{status}',[OrderController::class,'updateStatus']);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

