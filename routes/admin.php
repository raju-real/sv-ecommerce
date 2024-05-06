<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::view('admin', 'admin.admin_login');
Route::post('admin-login', \App\Http\Controllers\Admin\AdminLogin::class)->name('admin-login');

Route::group(['as' => 'admin.', 'middleware' => ['auth:admin']], function () {
    Route::controller(\App\Http\Controllers\Admin\DashboardController::class)->group(function () {
        Route::get('dashboard', 'dashboard')->name('dashboard');
    });
    Route::resource('categories',\App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('subcategories',\App\Http\Controllers\Admin\SubCategoryController::class);


    Route::get('logout', function () {
        \Illuminate\Support\Facades\Auth::logout();
        \Illuminate\Support\Facades\Session::reflash();
        return redirect()->route('home');
    })->name('logout');
});
