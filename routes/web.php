<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\AdminCustomerController;
use App\Http\Controllers\Admin\AdminPaymentController;
use App\Http\Controllers\Admin\AdminPropertyController;
use App\Http\Controllers\Admin\AdminRoomController;
use App\Http\Controllers\Admin\AdminRoomTypeController;
use App\Http\Controllers\Admin\AdminAmenityController;
use App\Http\Controllers\Admin\AdminRoomTypeAmenityController;
use App\Http\Controllers\Admin\AdminRoomTypeRateController;
use App\Http\Controllers\Admin\AdminCouponController;
use App\Http\Controllers\Admin\AdminInvoiceController;
use App\Http\Controllers\Admin\AdminRefundController;
use App\Http\Controllers\Admin\AdminReviewController;
use App\Http\Controllers\Admin\AdminJobController;
use App\Http\Controllers\Admin\AdminJobBatchController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminBookingGuestController;
use App\Http\Controllers\Admin\AdminBookingCouponController;
use App\Http\Controllers\Admin\AdminUserController;

Route::get('/', function () {
    return redirect()->route('admin.login');
});

// Laravel's `auth` middleware redirects guests to route('login') by default.
// This app uses `/admin/login`, so we provide a default login route.
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])
        ->middleware('guest')
        ->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])
        ->middleware('guest')
        ->name('login.submit');

    Route::get('/register', [AdminAuthController::class, 'showRegister'])
        ->middleware('guest')
        ->name('register');
    Route::post('/register', [AdminAuthController::class, 'register'])
        ->middleware('guest')
        ->name('register.submit');

    Route::post('/logout', [AdminAuthController::class, 'logout'])
        ->middleware('auth')
        ->name('logout');

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->middleware(['auth', 'admin'])
        ->name('dashboard');

    Route::get('/profile', [AdminProfileController::class, 'edit'])
        ->middleware(['auth', 'admin'])
        ->name('profile');
    Route::post('/profile', [AdminProfileController::class, 'update'])
        ->middleware(['auth', 'admin'])
        ->name('profile.update');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::resource('users', AdminUserController::class)->only(['index', 'show', 'update']);
        Route::patch('users/{user}/status', [AdminUserController::class, 'updateStatus'])->name('users.status');
        Route::resource('properties', AdminPropertyController::class)->except(['show']);
        Route::resource('room-types', AdminRoomTypeController::class)->except(['show']);
        Route::resource('rooms', AdminRoomController::class)->except(['show']);
        Route::resource('customers', AdminCustomerController::class)->except(['show']);
        Route::resource('bookings', AdminBookingController::class)->except(['show']);
        Route::resource('amenities', AdminAmenityController::class)->except(['show']);
        Route::resource('coupons', AdminCouponController::class)->except(['show']);
        Route::resource('invoices', AdminInvoiceController::class)->except(['show']);
        Route::resource('refunds', AdminRefundController::class)->except(['show']);
        Route::resource('reviews', AdminReviewController::class)->except(['show']);
        Route::resource('booking-guests', AdminBookingGuestController::class)->except(['show']);
        Route::get('jobs', [AdminJobController::class, 'index'])->name('jobs.index');
        Route::get('job-batches', [AdminJobBatchController::class, 'index'])->name('job-batches.index');
        Route::resource('settings', AdminSettingController::class)->except(['show']);

        Route::get('room-type-amenities', [AdminRoomTypeAmenityController::class, 'index'])->name('room-type-amenities.index');
        Route::get('room-type-amenities/{room_type}/edit', [AdminRoomTypeAmenityController::class, 'edit'])->name('room-type-amenities.edit');
        Route::put('room-type-amenities/{room_type}', [AdminRoomTypeAmenityController::class, 'update'])->name('room-type-amenities.update');

        Route::resource('room-type-rates', AdminRoomTypeRateController::class)->except(['show']);

        Route::get('booking-coupons', [AdminBookingCouponController::class, 'index'])->name('booking-coupons.index');
        Route::get('booking-coupons/{booking}/edit', [AdminBookingCouponController::class, 'edit'])->name('booking-coupons.edit');
        Route::put('booking-coupons/{booking}', [AdminBookingCouponController::class, 'update'])->name('booking-coupons.update');

        Route::get('payments', [AdminPaymentController::class, 'index'])->name('payments.index');
    });
});
