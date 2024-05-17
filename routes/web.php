<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/', [PageController::class, 'index'])->name('index');
Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
Route::get('/addproducts', [PageController::class, 'viewadd'])->name('viewadd')->middleware('auth');
Route::post('/addproduct', [PageController::class, 'addproducts'])->name('addproducts');
Route::get('/manage', [PageController::class, 'manage'])->name('manage');
Route::get('/edit/{id}', [PageController::class, 'edit'])->name('edit');
Route::post('/update/{id}', [PageController::class, 'update'])->name('update');
Route::get('/delete/{id}', [PageController::class, 'delete'])->name('delete');
Route::get('/details/{id}', [PageController::class, 'details'])->name('details');
Route::get('/addToCart/{id}', [PageController::class, 'add_to_cart'])->name('add_to_cart')->middleware('auth');
Route::get('/cartlist', [PageController::class, 'cartlist'])->name('cartlist');
Route::post('/updatecart/{id}', [PageController::class, 'updatecart'])->name('updatecart');
Route::get('/deletecart/{id}', [PageController::class, 'deletecart'])->name('deletecart');
Route::get('clear', [PageController::class, 'clear'])->name('clear');
Route::get('/checkout', [PageController::class, 'checkout'])->name('checkout');
Route::post('/check', [PageController::class, 'check'])->name('check');
Route::get('/payment', [PageController::class, 'payment'])->name('payment');
Route::post('/pay', [PageController::class, 'pay'])->name('pay');
Route::get('/orderdetails', [PageController::class, 'orderdetails'])->name('orderdetails');
Route::get('/vieworders', [PageController::class, 'vieworders'])->name('vieworders');
require __DIR__.'/auth.php';
