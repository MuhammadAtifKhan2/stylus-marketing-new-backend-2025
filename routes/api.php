<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\SubCategoryController;
use App\Http\Controllers\API\HomeController;
use App\Http\Controllers\API\AttributeController;
use App\Http\Controllers\API\AttributeOptionController;
use App\Http\Middleware\CheckUser;

// Route::get('/user', function (Request $request) {
//     return $request->user();

// })->middleware('auth:api');

Route::post('register',[HomeController::class,'register']);

Route::group(['middleware'=>CheckUser::class],function(){
    Route::get('test1',function(){ return response()->json('abc'); });
});

Route::post('login',[HomeController::class,'login']);


Route::resource('categories',CategoryController::class);
Route::resource('sub-categories',SubCategoryController::class);
Route::resource('attributes',AttributeController::class);
Route::resource('attribute-options',AttributeOptionController::class);

