<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MaintenanceComtroller;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


 Route::get('/BrandList',[BrandController::class,'BrandList']);
Route::get('/CategoryList',[CategoryController::class,'CategoryList']);
Route::get('/PolicyByType/{type}',[PolicyController::class,'PolicyByType']);
Route::get('/ListProductByCategory/{id}',[ProductController::class,'ListProductByCategory']);
Route::get('/ListProductByRemark/{remark}',[ProductController::class,'ListProductByRemark']);
Route::get('/ListProductByBrand/{id}',[ProductController::class,'ListProductByBrand']);
Route::get('/ListProductBySlider',[ProductController::class,'ListProductBySlider']);
Route::get('/ProductDetailsById/{id}',[ProductController::class,'ProductDetailsById']);

// user controller
Route::get('/SendOtp/{UserEmail}',[UserController::class,'SendOtp']);


Route::get('/ClearAppCache',[MaintenanceComtroller::class,'ClearAppCache']);
