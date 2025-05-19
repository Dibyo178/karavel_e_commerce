<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MaintenanceComtroller;
use App\Http\Controllers\PolicyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/BrandList',[BrandController::class,'BrandList']);
Route::get('/CategoryList',[CategoryController::class,'CategoryList']);
Route::get('/PolicyByType',[PolicyController::class,'PolicyByType']);


Route::get('/ClearAppCache',[MaintenanceComtroller::class,'ClearAppCache']);
