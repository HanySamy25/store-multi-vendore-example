<?php

use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductsController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// //breeze
// Route::get('/dashboard-breez', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::get('/',[HomeController::class,'index'])->name('home');//->name('dashboard');

Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
Route::get('/products/{product:slug}', [ProductsController::class, 'show'])->name('products.show'); //here model rout binding use slug not id


Route::resource('cart', CartController::class);
Route::get('checkout', [CheckoutController::class, 'create'])->name('checkout');
Route::post('checkout', [CheckoutController::class, 'store']);
Route::get('auth/user/2fa', [TwoFactorAuthentcationController::class, 'index'])
->name('front.2fa');

Route::post('currency', [CurrencyConverterController::class, 'store'])
->name('currency.store');

// Route::post('checkout/create-payment', [PaymentsController::class, 'store'])
// ->name('checkout.payment');


// require __DIR__.'/auth.php';

require __DIR__.'/admin.php';
