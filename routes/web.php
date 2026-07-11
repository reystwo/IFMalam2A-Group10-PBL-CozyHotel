<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('home');
})->name('home');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Password Reset Routes
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->name('dashboard');

// Admin Room Management
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\BookingController;

Route::resource('rooms', RoomController::class);
Route::resource('customers', CustomerController::class)->except(['show']);
Route::resource('bookings', BookingController::class)->except(['show', 'edit']);

Route::get('/rooms/{id}', function ($id) {
    return view('pages.rooms', ['id' => $id]);
})->name('rooms.show');

Route::get('/facilities', function () {
    return view('pages.facilities');
})->name('facilities.index');

use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\ActivityLogController;

Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');

Route::get('/activity-log', [ActivityLogController::class, 'index'])->name('activity-log');

// Customer Specific Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        return view('customer.home');
    })->name('customer.home');

    Route::get('/rooms-list', function () {
        return view('guest.rooms.index');
    })->name('guest.rooms.index');

    Route::get('/rooms-list/{id}', function ($id) {
        return view('guest.rooms.show', ['id' => $id]);
    })->name('guest.rooms.show');

    Route::get('/book-room/{id}', function ($id) {
        return view('guest.bookings.create', ['id' => $id]);
    })->name('guest.booking.create');

    Route::post('/book-room', function () {
        // Logika simpan booking akan diimplementasikan di Controller nanti
        return redirect()->route('guest.bookings.index')->with('success', 'Reservation created successfully!');
    })->name('guest.booking.store');

    Route::get('/my-bookings', function () {
        return view('guest.bookings.index');
    })->name('guest.bookings.index');

    Route::get('/my-bookings/{id}', function ($id) {
        return view('guest.bookings.show', ['id' => $id]);
    })->name('guest.bookings.show');

    Route::post('/my-bookings/{id}/cancel', function ($id) {
        return redirect()->route('guest.bookings.index')->with('info', 'Booking cancelled.');
    })->name('guest.bookings.cancel');

    Route::get('/my-bookings/{id}/invoice', function ($id) {
        return "Invoice for booking #$id";
    })->name('guest.bookings.invoice');

    Route::get('/profile', function () {
        return view('pages.profile.edit');
    })->name('profile');
});

// Customer Specific Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        return view('customer.home');
    })->name('customer.home');

    Route::get('/rooms-list', function () {
        return view('guest.rooms.index');
    })->name('guest.rooms.index');

    Route::get('/rooms-list/{id}', function ($id) {
        return view('guest.rooms.show', ['id' => $id]);
    })->name('guest.rooms.show');

    Route::get('/book-room/{id}', function ($id) {
        return view('guest.bookings.create', ['id' => $id]);
    })->name('guest.booking.create');

    Route::post('/book-room', function () {
        // Logika simpan booking akan diimplementasikan di Controller nanti
        return redirect()->route('guest.bookings.index')->with('success', 'Reservation created successfully!');
    })->name('guest.booking.store');

    Route::get('/my-bookings', function () {
        return view('guest.bookings.index');
    })->name('guest.bookings.index');

    Route::get('/my-bookings/{id}', function ($id) {
        return view('guest.bookings.show', ['id' => $id]);
    })->name('guest.bookings.show');

    Route::post('/my-bookings/{id}/cancel', function ($id) {
        return redirect()->route('guest.bookings.index')->with('info', 'Booking cancelled.');
    })->name('guest.bookings.cancel');

    Route::get('/my-bookings/{id}/invoice', function ($id) {
        return "Invoice for booking #$id";
    })->name('guest.bookings.invoice');

    Route::get('/profile', function () {
        return view('pages.profile.edit');
    })->name('profile');
});

Route::get('/invoices/{id}', function ($id) {
    return view('pages.invoice', ['id' => $id]);
})->name('invoices.show');
