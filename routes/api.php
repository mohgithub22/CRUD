<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('api/customers',[CustomerController::class ,'create']);
Route::put('api/customers/{cusotmers}' ,[CustomerController::class,'update']);