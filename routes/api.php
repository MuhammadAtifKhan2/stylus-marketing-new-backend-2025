<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\SubCategoryController;
use App\Http\Controllers\API\HomeController;

Route::get('/user', function (Request $request) {
    return $request->user();

})->middleware('auth:api');

Route::group(['middleware'=>'auth:api'],function(){
    Route::get('test1',function(){ return response()->json('abc'); });
});

Route::get('login',function() { return response()->json('bcd'); });


Route::resource('categories',CategoryController::class);
Route::resource('sub-categories',SubCategoryController::class);

Route::post('register',[HomeController::class,'register']);
