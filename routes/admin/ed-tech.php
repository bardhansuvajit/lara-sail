<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\School\Board\SchoolBoardController;
use App\Http\Controllers\Admin\School\Class\SchoolClassController;
use App\Http\Controllers\Admin\School\Subject\SchoolSubjectController;
use App\Http\Controllers\Admin\School\Listing\SchoolListingController;

Route::prefix('school')->name('school.')->group(function() {
    // board
    Route::prefix('board')->name('board.')->controller(SchoolBoardController::class)->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update', 'update')->name('update');
        Route::delete('/delete/{id}', 'delete')->name('delete');
        Route::post('/bulk', 'bulk')->name('bulk');
        Route::post('/import', 'import')->name('import');
        Route::get('/export/{type}', 'export')->name('export');
        Route::post('/position', 'position')->name('position');
    });

    // class
    Route::prefix('class')->name('class.')->controller(SchoolClassController::class)->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update', 'update')->name('update');
        Route::delete('/delete/{id}', 'delete')->name('delete');
        Route::post('/bulk', 'bulk')->name('bulk');
        Route::post('/import', 'import')->name('import');
        Route::get('/export/{type}', 'export')->name('export');
        Route::post('/position', 'position')->name('position');
    });

    // subject
    Route::prefix('subject')->name('subject.')->controller(SchoolSubjectController::class)->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update', 'update')->name('update');
        Route::delete('/delete/{id}', 'delete')->name('delete');
        Route::post('/bulk', 'bulk')->name('bulk');
        Route::post('/import', 'import')->name('import');
        Route::get('/export/{type}', 'export')->name('export');
        Route::post('/position', 'position')->name('position');
    });

    // school
    Route::prefix('listing')->name('listing.')->controller(SchoolListingController::class)->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update', 'update')->name('update');
        Route::delete('/delete/{id}', 'delete')->name('delete');
        Route::post('/bulk', 'bulk')->name('bulk');
        Route::post('/import', 'import')->name('import');
        Route::get('/export/{type}', 'export')->name('export');
        Route::post('/position', 'position')->name('position');
    });
});