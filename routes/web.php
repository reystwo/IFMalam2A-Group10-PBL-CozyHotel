<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->name('dashboard');

Route::get('/rooms', function () {
    return view('pages.rooms');
})->name('rooms.index');

Route::get('/facilities', function () {
    return view('pages.facilities');
})->name('facilities.index');

Route::get('/customers', function () {
    return view('pages.customers');
})->name('customers.index');

Route::get('/bookings', function () {
    return view('pages.bookings');
})->name('bookings.index');

Route::get('/transactions', function () {
    return view('pages.transactions');
})->name('transactions.index');

Route::get('/activity-log', function () {
    return view('pages.activity-log');
})->name('activity-log');

Route::get('/invoices/{id}', function ($id) {
    return view('pages.invoice', ['id' => $id]);
})->name('invoices.show');
