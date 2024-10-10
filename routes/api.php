<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('customers',[CustomerController::class ,'store']);


Route::middleware(['auth:sanctum',config('jetstream.auth_session'),
'verified',])->group(function () {
    Route::resource('customers', CustomerController::class)->names('customers');



});

Route::post('/search' , [CustomerController::class , 'search']);