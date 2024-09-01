<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CheckingAccountControllerAPI;
use App\Http\Controllers\Api\InvoiceControllerAPI;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// -------- Services Ammount APIs -------- //
Route::get('/checkingAccount', [CheckingAccountControllerAPI::class, 'index']);
Route::get('/checkingAccount/{id}', [CheckingAccountControllerAPI::class, 'show']);

// -------- Invoices Ammount APIs -------- //
Route::get('/invoice', [InvoiceControllerAPI::class, 'index']);
Route::get('/invoice/{id}', [InvoiceControllerAPI::class, 'show']);




