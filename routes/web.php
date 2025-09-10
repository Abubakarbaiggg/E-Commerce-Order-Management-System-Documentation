<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PaymentController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('order',OrderController::class);
    Route::resource('product',ProductController::class);
    Route::post('productbuy/{product}',[ProductController::class,'productbuy'])->name('productbuy');
    Route::get('cardview',[OrderController::class,'cardview'])->name('cardview');
    Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');
    Route::resource('role',RoleController::class);
    Route::resource('permission',PermissionController::class);
    Route::resource('user',UserController::class);
    Route::post('addPermissionToRole',[RoleController::class,'addPermissionToRole'])->name('addPermissionToRole');

});

require __DIR__.'/auth.php';
