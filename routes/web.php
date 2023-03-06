<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseOrdersController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\TransactionsController;
use Illuminate\Support\Facades\Redirect;
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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('suppliers', SuppliersController::class)
        ->except('show');

    Route::resource('products', ProductsController::class)
        ->except('show');

    Route::resource('purchase_orders', PurchaseOrdersController::class)
        ->except('show');

    Route::resource('purchase_orders.transactions', TransactionsController::class)
        ->only('store', 'update', 'destroy');

    Route::resource('users', RegisteredUserController::class)
        ->only('index', 'create', 'store', 'destroy');
});


// Routes for custom methods.

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/purchase_orders/create/supp_id', [SuppliersController::class, 'get'])->name('suppliers.get');
    Route::post('/purchase_orders/edit/prod_id/', [ProductsController::class, 'get'])->name('products.get');
    Route::get('/generate-po-pdf/{purchaseOrder}', [PurchaseOrdersController::class, 'generatePDF'])->name('po-pdf');
    Route::post('/import-po/import/{purchaseOrder}', [TransactionsController::class, 'import'])->name('po-import');
});

require __DIR__ . '/auth.php';


Route::fallback(function () {
    return Controller::error();
});
