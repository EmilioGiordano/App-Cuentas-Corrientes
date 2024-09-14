<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FiscalConditionController;
use App\Http\Controllers\CheckingAccountController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReceiptController;
use App\http\Controllers\GoogleLoginController;
use App\http\Controllers\UserSettingsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // Si el usuario ya está autenticado, redirigirlo a la página de inicio
    if (Auth::check()) {
        return redirect('/home'); // O a cualquier otra página de inicio
    }
    // De lo contrario, mostrar la vista de inicio de sesión
    return view('auth.login');
})->name('login');


//rutas para el logueo de google
Route::get('/google/redirect', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');





Auth::routes();

// PDF de Servicios y Recibos
Route::get('invoices/{id}/pdf', [InvoiceController::class, 'createPDF'])->name('invoices.pdf');
Route::get('receipts/{id}/pdf', [ReceiptController::class, 'createPDF'])->name('receipts.pdf');

// VER PDF
Route::get('invoices/{id}/pdf', [InvoiceController::class, 'showPDF'])->name('invoices.pdf');
// DESCARGAR PDF
Route::get('invoices/{id}/download-pdf', [InvoiceController::class, 'downloadPDF'])->name('invoices.download');
Route::get('receipts/{id}/download-pdf', [ReceiptController::class, 'downloadPDF'])->name('receipts.download');





Route::resource('clients', App\Http\Controllers\ClientController::class)->middleware('auth');
Route::resource('fiscal-conditions', App\Http\Controllers\FiscalConditionController::class)->middleware('auth');
Route::resource('checking-accounts', App\Http\Controllers\CheckingAccountController::class)->middleware('auth');
Route::resource('services', App\Http\Controllers\ServiceController::class)->middleware('auth');
Route::resource('payments', App\Http\Controllers\PaymentController::class)->middleware('auth');

Route::resource('receipts', App\Http\Controllers\ReceiptController::class)->middleware('auth');
Route::resource('invoices', App\Http\Controllers\InvoiceController::class)->middleware('auth');


// Ruta para el método create (muestra lista de clientes para elegir)
Route::get('checking-accounts/create', [CheckingAccountController::class, 'create'])->name('checking-accounts.create')->middleware('auth');

// Ruta para el método createForClient (crea la cuenta automáticamente para un cliente específico)
Route::get('checking-accounts/createForClient/{client_id}', [CheckingAccountController::class, 'createForClient'])->name('checking-accounts.createForClient')->middleware('auth');

//Ruta para ver resumen de cuenta
// Route::get('checking-accounts/show/{client_id}', [CheckingAccountController::class, 'show'])->name('checking-accounts.show')->middleware('auth');


Route::get('payments/create/{service_id}/{cuenta_id}', [App\Http\Controllers\PaymentController::class, 'create'])->name('payments.create')->middleware('auth');


Route::post('invoices/create', [InvoiceController::class, 'create'])->name('invoices.create');
Route::post('receipts/create', [ReceiptController::class, 'create'])->name('receipts.create');

Route::get('payments/{id}/showPaymentsPerAccount', [App\Http\Controllers\PaymentController::class, 'showPaymentsPerAccount'])->name('payments.showPaymentsPerAccount');
Route::get('payments/{id}/showPaymentsPerService', [App\Http\Controllers\PaymentController::class, 'showPaymentsPerService'])->name('payments.showPaymentsPerService');


// COMPROBANTE DE 1 FACTURA C
Route::get('invoices/{id}/showInvoicePerService', [App\Http\Controllers\InvoiceController::class, 'showInvoicePerService'])->name('invoices.showInvoicePerService');
// COMPROBANTE DE 1 PAGO 
Route::get('receipts/{id}/showReceiptPerPayment', [App\Http\Controllers\ReceiptController::class, 'showReceiptPerPayment'])->name('receipts.showReceiptPerPayment');

// ->middleware('auth');
Route::get( '/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Profile
Route::get('/NewPassword',  [UserSettingsController::class, 'NewPassword'])->name('NewPassword')->middleware('auth');
Route::post('/updateProfile', [UserSettingsController::class, 'updateProfile'])->name('updateProfile')->middleware('auth');

Route::post('/change/password',  [UserSettingsController::class, 'changePassword'])->name('changePassword');

// Ruta para mostrar los servicios por cuenta
Route::get('accounts/{id}/services', [App\Http\Controllers\ServicePerAccountController::class, 'showServicesPerAccount'])->name('services.showServicesPerAccount');
// Ruta para crear un servicio en una cuenta específica
route::get('accounts/{id}/create-for-account', [App\Http\Controllers\ServicePerAccountController::class, 'createForAccount'])->name('services.createForAccount');// Ruta para la vista formForAccount.blade.php
Route::post('accounts/{id}/store-for-account', [App\Http\Controllers\ServicePerAccountController::class, 'storeForAccount'])->name('services.storeForAccount');
route::get('accounts/{id}/services/summary-pdf', [App\Http\Controllers\ServicePerAccountController::class, 'generateSummaryPDF'])->name('services.generateSummaryPDF');
