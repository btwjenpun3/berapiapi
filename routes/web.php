<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HubController;
use Illuminate\Support\Facades\Route;

Route::prefix('/auth')
    ->name('auth.')
    ->controller(AuthController::class)
    ->group(function() {
        Route::get('/login', 'login')->name('login')->middleware('guest'); 
        Route::get('/register', 'register')->name('register')->middleware('guest'); 
    });

Route::prefix('/dashboard')
    ->name('dashboard.')
    ->middleware('auth')
    ->controller(DashboardController::class)
    ->group(function() {
        Route::get('/', 'index')->name('index'); 
    });

Route::prefix('/key')
    ->name('key.')
    ->middleware('auth')
    ->controller(ApiController::class)
    ->group(function() {
        Route::get('/', 'index')->name('index'); 
    });

Route::prefix('/hub')
    ->name('hub.')
    ->middleware('auth')
    ->controller(HubController::class)
    ->group(function() {
        Route::get('/', 'index')->name('index'); 
        Route::get('/create', 'create')->name('create');
    });

Route::prefix('/category')
    ->name('category.')
    ->middleware('auth')
    ->controller(CategoryController::class)
    ->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create'); 
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{slug}', 'edit')->name('edit');
        Route::post('/update/{slug}', 'update')->name('update');
        Route::delete('/delete/{slug}', 'delete')->name('delete');
    });