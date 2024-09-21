<?php

use App\Http\Controllers\ApiHandleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/{slug}/{endpoint}', [ApiHandleController::class, 'handle'])
            ->where('endpoint', '.*')
            ->middleware(['x-berapiapi']);
