<?php

use App\Domain\Auth\Controllers\SignInController;
use App\Domain\Auth\Controllers\SignOutController;
use App\Domain\Link\Controllers\CreateLinkController;
use App\Domain\Link\Controllers\GetListController;
use App\Domain\Link\Controllers\GetController;
use App\Domain\Link\Controllers\RedirectController;
use App\Domain\Link\Controllers\UpdateLinkController;
use App\Domain\Link\Controllers\DeleteLinkController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('sign-in', SigninController::class);
    Route::post('sign-out', SignoutController::class);
});

Route::middleware('auth')->prefix('link')->group(function () {
    Route::post('/', CreateLinkController::class);
    Route::post('/{id}', UpdateLinkController::class);
    Route::delete('/{id}', DeleteLinkController::class);
    Route::get('/', GetListController::class);
    Route::get('/{id}', GetController::class);
});

//Should be last
Route::get('/{code}', RedirectController::class);
