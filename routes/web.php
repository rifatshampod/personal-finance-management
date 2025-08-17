<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return Auth::check() ? redirect()->route('dashboard') : view('welcome');
});

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // App routes
    Route::resource('accounts', \App\Http\Controllers\AccountController::class);
    Route::resource('counterparties', \App\Http\Controllers\CounterpartyController::class);
    Route::resource('categories', \App\Http\Controllers\CategoryController::class);
    Route::resource('transactions', \App\Http\Controllers\TransactionController::class)->except('show');
    Route::get('transactions/export', [\App\Http\Controllers\TransactionExportController::class, 'index'])->middleware('throttle:10,1')->name('transactions.export');
    Route::resource('obligations', \App\Http\Controllers\ObligationController::class);
    Route::post('obligations/{obligation}/payments', [\App\Http\Controllers\ObligationPaymentController::class, 'store'])->name('obligations.payments.store');
    Route::delete('obligations/{obligation}/payments/{payment}', [\App\Http\Controllers\ObligationPaymentController::class, 'destroy'])->name('obligations.payments.destroy');
    Route::view('reports', 'reports.index')->name('reports.index');
    Route::view('settings', 'settings.index')->name('settings.index');
});

require __DIR__.'/auth.php';