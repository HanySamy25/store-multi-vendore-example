<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ProductsControllers;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Middleware\CheckUserType;
use Illuminate\Support\Facades\Route;

//Pa$$w0rd! Verfied //,'auth.type:admin,super-admin'
Route::middleware(['auth:admin'])->group(function () {
    Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {

        Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('/categories', CategoriesController::class);
        Route::resource('/products', ProductsControllers::class);
    });
});




// Not Working Keep Searching Why
// Route::group(['midlleware'=>'auth','as'=>'admin.','prefix'=>'admin'],function(){

//     Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
//     Route::resource('/categories', CategoriesController::class);
//     Route::resource('/products', ProductsControllers::class)->middleware('auth');

// });
