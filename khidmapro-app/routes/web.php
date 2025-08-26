<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::middleware(['auth','role:pro'])->group(function () {
    Route::resource('services', \App\Http\Controllers\ServiceController::class);
    Route::resource('bookings', \App\Http\Controllers\BookingController::class);
    Route::resource('invoices', \App\Http\Controllers\InvoiceController::class);
});

Route::middleware(['auth','role:pro'])->group(function () {
    Route::post('invoices/{invoice}/mark-paid', [\App\Http\Controllers\InvoiceController::class, 'markPaid'])->name('invoices.markPaid');
    Route::post('invoices/{invoice}/checkout', [\App\Http\Controllers\InvoiceController::class, 'checkout'])->name('invoices.checkout');
});

Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('admin', \App\Http\Controllers\Admin\DashboardController::class)->name('admin.dashboard');
});
