<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Class\ClassController;
use App\Http\Controllers\Admin\Subject\SubjectController;
use App\Http\Controllers\Admin\School\SchoolController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['redirectAdminIfNotAuthenticated'])->group(function () {

        // class
        Route::prefix('class')->name('class.')->controller(ClassController::class)->group(function() {
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
        Route::prefix('subject')->name('subject.')->controller(SubjectController::class)->group(function() {
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
        Route::prefix('school')->name('school.')->controller(SchoolController::class)->group(function() {
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
});