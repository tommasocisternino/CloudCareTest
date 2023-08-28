<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::prefix("v1")->group(function () {
    Route::get('check', [AuthController::class, 'check'])->middleware('jwt.auth')->name('login');
});

