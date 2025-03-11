<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuotationController;

    Route::get('/', function () {
        return redirect()->route('login');
    });
   
    Route::fallback(function () {
        return response()->view('errors.404', [], 404);
    });
    Auth::routes();

    Route::middleware(['auth', 'pharmacy'])->group(function() {
        Route::get('/pharmacy/prescriptions', [PrescriptionController::class, 'index'])->name('pharmacy.prescriptions.index');
        Route::get('/pharmacy/quotation/create/{prescription}', [QuotationController::class, 'create'])->name('pharmacy.quotation.create');
        Route::post('/pharmacy/quotation/store/{prescription}', [QuotationController::class, 'store'])->name('pharmacy.quotation.store');
    });

    Route::middleware(['auth'])->group(function() {
        Route::get('/user/prescription', [PrescriptionController::class, 'userPrescription'])->name('user.prescription.view');
        Route::get('/user/quotations/{prescription}', [QuotationController::class, 'userQuotations'])->name('user.quotations.index');
        Route::get('/prescriptions/create', [PrescriptionController::class, 'create'])->name('prescriptions.create');
        Route::post('/prescriptions/store', [PrescriptionController::class, 'store'])->name('prescriptions.store');
    });

    Route::patch('/user/quotations/{quotation}', [QuotationController::class, 'updateStatus'])->name('user.quotations.update');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    Route::middleware(['auth', 'pharmacy'])->group(function () {
        Route::get('/pharmacy/prescriptions', [PrescriptionController::class, 'index'])->name('pharmacy.prescriptions.index');
    });
    Route::middleware(['auth', 'user'])->group(function () {
        Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    });


