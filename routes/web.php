<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseOrdersController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\TransactionsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//
//Route::get('/', function () {
//    return view('home');
//})->name('home');

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Resource Controllers

Route::middleware('auth')->group(function () {
    Route::resources([
        'suppliers' => SuppliersController::class,
        'products' => ProductsController::class,
        'purchase_orders' => PurchaseOrdersController::class,
        'purchase_orders.transactions' => TransactionsController::class,
        ]);
    Route::post('/purchase_orders/create/supp_id', [SuppliersController::class, 'get'])->name('suppliers.get');
    Route::post('/purchase_orders/edit/prod_id/{order}', [ProductsController::class, 'get'])->name('products.get');
});

require __DIR__.'/auth.php';
