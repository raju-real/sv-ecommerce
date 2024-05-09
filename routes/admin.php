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
    //Attributes
    Route::resource('categories',\App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('subcategories',\App\Http\Controllers\Admin\SubCategoryController::class);
    Route::resource('sub-subcategories',\App\Http\Controllers\Admin\SubSubcategoryController::class);
    Route::resource('brands',\App\Http\Controllers\Admin\BrandController::class);
    Route::resource('sizes',\App\Http\Controllers\Admin\SizeController::class);
    Route::resource('colors',\App\Http\Controllers\Admin\ColorController::class);
    Route::resource('units',\App\Http\Controllers\Admin\UnitController::class);
    Route::resource('products',\App\Http\Controllers\Admin\ProductController::class);

    Route::controller(\App\Http\Controllers\Admin\SettingController::class)->group(function () {
       Route::get('site-settings','siteSettings')->name('site-settings');
       Route::put('update-site-settings','updateSiteSettings')->name('update-site-settings');
    });


    Route::get('logout', function () {
        \Illuminate\Support\Facades\Auth::logout();
        \Illuminate\Support\Facades\Session::reflash();
        return redirect()->route('home');
    })->name('logout');
});
