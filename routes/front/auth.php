<?php

// use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Front\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Front\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Front\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Front\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Front\Auth\NewPasswordController;
use App\Http\Controllers\Front\Auth\PasswordController;
use App\Http\Controllers\Front\Auth\PasswordResetLinkController;
use App\Http\Controllers\Front\Auth\RegisteredUserController;
use App\Http\Controllers\Front\Auth\VerifyEmailController;
use App\Http\Controllers\Front\Account\AccountController;
use App\Http\Controllers\Front\Address\AddressController;
use App\Http\Controllers\Front\Order\OrderController;
use App\Http\Controllers\Front\Wishlist\WishlistController;

Route::name('front.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
        Route::post('register', [RegisteredUserController::class, 'store']);

        Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login.store');

        Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
        Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
        Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
    });

    Route::middleware('auth')->group(function () {
        Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');
        Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
        Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');

        Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
        Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
        Route::put('password', [PasswordController::class, 'update'])->name('password.update');
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

        // account
        Route::prefix('account')->name('account.')->controller(AccountController::class)->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/edit', 'edit')->name('edit');
            Route::post('/update', 'update')->name('update');
            Route::post('/update/optional', 'updateOptional')->name('update.optional');
        });

        // order
        Route::prefix('order')->name('order.')->controller(OrderController::class)->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/invoice/{orderNumber}', 'invoice')->name('invoice');
        });

        // wishlist
        Route::prefix('wishlist')->name('wishlist.')->controller(WishlistController::class)->group(function() {
            Route::get('/', 'index')->name('index');
        });

        // address
        Route::prefix('address')->name('address.')->controller(AddressController::class)->group(function() {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::delete('/delete/{id}', 'delete')->name('delete');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update', 'update')->name('update');
        });
    });
});
