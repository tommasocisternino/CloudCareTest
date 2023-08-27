<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home')->middleware('jwtcookie.auth');

Route::get('login', function () {
    return view("auth.login");
})->middleware("jwtcookie.guest")->name('login-view');

Route::post('login', [AuthController::class, 'login'])->name('login');
