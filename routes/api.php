<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('customers',[CustomerController::class ,'store']);
Route::put('customers/{cusotmers}' ,[CustomerController::class,'update']);
Route::post('/search' , [CustomerController::class , 'search']);