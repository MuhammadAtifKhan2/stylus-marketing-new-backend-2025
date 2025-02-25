<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\SubCategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::resource('categories',CategoryController::class);
Route::resource('sub-categories',SubCategoryController::class);
