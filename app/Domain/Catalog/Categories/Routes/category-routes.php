<?php

use App\Domain\Catalog\Categories\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;


Route::get('/categories',[CategoryController::class,'getAll']);
Route::get('/category/{id}',[CategoryController::class,'getById']);
Route::post('/category/create',[CategoryController::class,'store']);
Route::put('/category/update/{id}',[CategoryController::class,'edit']);
Route::put('/category/delete/{id}',[CategoryController::class,'destroy']);