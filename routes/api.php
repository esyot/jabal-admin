<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\StudentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/products', [ProductController::class, 'index'])->middleware('auth:api');

Route::get('/students', [StudentController::class, 'index'])->middleware('auth:api');

Route::delete('/delete/{id}', [StudentController::class, 'delete']);
