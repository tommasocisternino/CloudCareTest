<?php

use App\Http\Controllers\BeersController;
use Illuminate\Support\Facades\Route;


Route::prefix("v1")->group(function () {
    Route::get('get-beers-list', [BeersController::class, 'getBeersList'])->middleware('jwt.auth')->name('get-beers-list');
});

