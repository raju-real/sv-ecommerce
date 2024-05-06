<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('category-wise-subcategories/{category_id}',function ($category_id) {
   return \App\Models\SubCategory::where('category_id',$category_id)->select('id','category_id','name')->get();
});

Route::get('subcategory-wise-sub-subcategories/{subcategory_id}',function ($subcategory_id) {
   return \App\Models\SubSubCategory::where('subcategory_id',$subcategory_id)->select('id','subcategory_id','name')->get();
});
