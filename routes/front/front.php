<?php

// use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Front\Ip\IpController;
use App\Http\Controllers\Front\Home\IndexController;
use App\Http\Controllers\Front\Category\CategoryController;
use App\Http\Controllers\Front\Collection\CollectionController;
use App\Http\Controllers\Front\Cart\CartController;
use App\Http\Controllers\Front\Checkout\CheckoutController;
use App\Http\Controllers\Front\Profile\LoginController;
use App\Http\Controllers\Front\Order\OrderController;
use App\Http\Controllers\Front\Wishlist\WishlistController;
use App\Http\Controllers\Front\Search\SearchController;
use App\Http\Controllers\Front\Content\ContentPageController;
use App\Http\Controllers\Front\Faq\FaqController;
use App\Http\Controllers\Front\Error\ErrorPageController;
use App\Http\Controllers\Front\Product\ProductController;
use App\Http\Controllers\Front\Review\ProductReviewController;

use App\Http\Controllers\Front\Payment\PaymentController;
use App\Http\Controllers\Front\Payment\Razorpay\RazorpayController;

Route::name('front.')->group(function () {
    // home
    Route::name('home.')->group(function() {
        Route::get('/', [IndexController::class, 'index'])->name('index');
    });

    // category
    Route::name('category.')->prefix('category')->group(function() {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/{slug}', [CategoryController::class, 'detail'])->name('detail');
    });

    // collection
    Route::name('collection.')->prefix('collection')->group(function() {
        Route::get('/', [CollectionController::class, 'index'])->name('index');
        Route::get('/{slug}', [CollectionController::class, 'detail'])->name('detail');
    });

    // wishlist
    Route::name('wishlist.')->prefix('wishlist')->group(function() {
        Route::post('/check-status', [WishlistController::class, 'checkStatus'])->name('check');
        Route::get('/toggle/{productId}', [WishlistController::class, 'toggle'])->name('toggle');
    });

    // search
    Route::name('search.')->group(function() {
        Route::get('/search', [SearchController::class, 'index'])->name('index');
    });

    // cart
    Route::name('cart.')->prefix('cart')->controller(CartController::class)->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/fetch', 'fetch')->name('fetch');
        Route::post('/store', 'store')->name('store');
        Route::post('/qty/update', 'qtyUpdate')->name('qty.update');
        Route::post('/update', 'update')->name('update');
        Route::delete('/delete/{id}', 'delete')->name('delete');
    });

    // checkout
    Route::name('checkout.')->group(function() {
        Route::get('/checkout', [CheckoutController::class, 'index'])->name('index');
    });

    // order
    Route::name('order.')->prefix('order')->controller(OrderController::class)->group(function() {
        Route::post('/store', 'store')->name('store');
        Route::get('/thankyou', 'thankyou')->name('thankyou');
    });

    // faq
    Route::name('faq.')->prefix('faq')->controller(FaqController::class)->group(function() {
        Route::get('/', 'index')->name('index');
    });

    // Explicit content pages with hardcoded slugs
    Route::name('content.')->controller(ContentPageController::class)->group(function() {
        Route::get('/terms-and-conditions', 'showTerms')->name('terms');
        Route::get('/privacy-policy', 'showPrivacy')->name('privacy');
        Route::get('/return-policy', 'showReturn')->name('return');
        Route::get('/refund-policy', 'showRefund')->name('refund');
        Route::get('/support', 'showSupport')->name('support');
        Route::get('/cookie-policy', 'showCookie')->name('cookie');
        Route::get('/shipping-info', 'showShipping')->name('shipping');
        Route::get('/size-guide', 'showSizeGuide')->name('size-guide');
        Route::get('/legal-notice', 'showLegalNotice')->name('legal-notice');
        Route::get('/terms-of-use', 'showTermsOfUse')->name('terms-of-use');
        Route::get('/affiliate-program', 'showAffiliateProgram')->name('affiliate-program');
        Route::get('/exclusive-offers', 'showExclusiveOffers')->name('exclusive-offers');

        Route::get('/contact-us', 'contactUs')->name('contact');
        Route::get('/about-us', 'aboutUs')->name('about');
    });

    // pages
    Route::name('error.')->group(function() {
        Route::get('/404', [ErrorPageController::class, 'err404'])->name('404');
    });

    // reviews
    Route::name('review.')->prefix('product-reviews')->controller(ProductReviewController::class)->group(function() {
        Route::get('{slug}', 'listByProduct')->name('list');
        Route::get('/create/{slug}', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
    });

    // payment
    Route::name('payment.')->prefix('payment')->group(function() {
        Route::get('/initiate/{gateway_id}', [PaymentController::class, 'initiate'])->name('initiate');

        Route::name('razorpay.')->prefix('razorpay')->controller(RazorpayController::class)->group(function() {
            Route::post('/create-order', 'createOrder')->name('create');
            Route::post('/verify', 'verify')->name('verify');
            Route::post('/fail', 'handleFail')->name('fail');
            Route::post('/webhook', 'webhook')->name('webhook');
        });
    });

    // product
    /*
    // OLD PRODUCT ROUTE
    Route::name('product.')->group(function() {
        Route::get('{slug}', [ProductController::class, 'detail'])->name('detail');
    });
    */
    Route::name('product.')->group(function() {
        Route::get('{slug}', [ProductController::class, 'detail'])
            // ->where('slug', '^(?!terms-and-conditions|privacy-policy|return-policy|refund-policy|support|404).+$')
            ->where('slug', '^(?!terms-and-conditions$|privacy-policy$|return-policy$|refund-policy$|support$|contact-us$|404$).+')
            ->name('detail');
    });
});