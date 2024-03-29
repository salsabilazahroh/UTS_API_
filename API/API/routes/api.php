<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// User Routes
Route::post('/users', [\App\Http\Controllers\UserController::class, 'register']);
Route::post('/users/login', [\App\Http\Controllers\UserController::class, 'login']);
Route::middleware(\App\Http\Middleware\ApiAuthMiddleware::class)->group(function () {
    Route::get('/users/current', [\App\Http\Controllers\UserController::class, 'get']);
    Route::patch('/users/current', [\App\Http\Controllers\UserController::class, 'update']);
    Route::delete('/users/logout', [\App\Http\Controllers\UserController::class, 'logout']);
});

// Contact Routes
Route::middleware(\App\Http\Middleware\ApiAuthMiddleware::class)->group(function () {
    Route::post('/contacts', [\App\Http\Controllers\ContactController::class, 'create']);
    Route::get('/contacts/{id}', [\App\Http\Controllers\ContactController::class, 'get']);
    Route::patch('/contacts/{id}', [\App\Http\Controllers\ContactController::class, 'update']);
    Route::delete('/contacts/{id}', [\App\Http\Controllers\ContactController::class, 'delete']);

    // Address Routes
    Route::post('/contacts/{contact_id}/addresses', [\App\Http\Controllers\AddressController::class, 'create']);
    Route::get('/contacts/{contact_id}/addresses', [\App\Http\Controllers\AddressController::class, 'getList']);
    Route::get('/contacts/{contact_id}/addresses/{address_id}', [\App\Http\Controllers\AddressController::class, 'get']);
    Route::patch('/contacts/{contact_id}/addresses/{address_id}', [\App\Http\Controllers\AddressController::class, 'update']);
    Route::delete('/contacts/{contact_id}/addresses/{address_id}', [\App\Http\Controllers\AddressController::class, 'delete']);
});
