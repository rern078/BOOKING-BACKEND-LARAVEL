<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;

Route::post('/auth/login', [AuthApiController::class, 'login']);

Route::middleware('api.token')->group(function () {
    Route::get('/me', [AuthApiController::class, 'me']);
    Route::post('/auth/logout', [AuthApiController::class, 'logout']);
});

