<?php

use App\Domain\Auth\Controllers\SignInController;
use App\Domain\Auth\Controllers\SignOutController;
use App\Domain\Link\Controllers\CreateLinkController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('auth')->group(function () {
    Route::post('sign-in', SigninController::class);
    Route::post('sign-out', SignoutController::class);
});

Route::middleware('auth')->prefix('link')->group(function () {
    Route::post('/', CreateLinkController::class);
});
