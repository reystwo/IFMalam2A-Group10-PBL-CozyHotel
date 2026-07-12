<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// ============== IMPORT GUEST CONTROLLERS ==============
use App\Http\Controllers\Guest\RoomController as GuestRoomController;
use App\Http\Controllers\Guest\BookingController as GuestBookingController;

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

// ============================================================
// CUSTOMER SPECIFIC ROUTES (Authenticated)
// ============================================================
Route::middleware(['auth'])->group(function () {

    // ----- HOME PAGE -----
    Route::get('/home', [GuestRoomController::class, 'index'])->name('customer.home');

    // ----- ROOM LIST PAGE -----
    // PERBAIKAN: Menggunakan controller untuk mengambil data rooms
    Route::get('/rooms-list', [GuestRoomController::class, 'list'])->name('guest.rooms.index');

    // ----- ROOM DETAIL PAGE -----
    Route::get('/rooms-list/{id}', [GuestRoomController::class, 'show'])->name('guest.rooms.show');

    // ----- BOOKING ROUTES -----
    Route::get('/book-room/{id}', [GuestBookingController::class, 'create'])->name('guest.booking.create');
    Route::post('/book-room', [GuestBookingController::class, 'store'])->name('guest.booking.store');
    Route::get('/my-bookings', [GuestBookingController::class, 'index'])->name('guest.bookings.index');
    Route::get('/my-bookings/{id}', [GuestBookingController::class, 'show'])->name('guest.bookings.show');
    Route::post('/my-bookings/{id}/cancel', [GuestBookingController::class, 'cancel'])->name('guest.bookings.cancel');
    Route::get('/my-bookings/{id}/invoice', [GuestBookingController::class, 'invoice'])->name('guest.bookings.invoice');

    // ----- PROFILE PAGE -----
    Route::get('/profile', function () {
        return view('pages.profile.edit');
    })->name('profile');
});

// ----- INVOICE PAGE -----
Route::get('/invoices/{id}', function ($id) {
    return view('pages.invoice', ['id' => $id]);
})->name('invoices.show');

