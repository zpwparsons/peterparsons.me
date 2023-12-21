<?php

use App\Http\Controllers\Api\ArticlesController;
use App\Http\Controllers\Api\TagsController;
use App\Http\Controllers\Api\ToolsController;
use App\Http\Controllers\PersonalAccessTokenController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('articles', ArticlesController::class);

    Route::apiResource('tags', TagsController::class);

    Route::apiResource('tools', ToolsController::class);

    Route::get('/user', [UserProfileController::class, 'show'])->name('user-profile.show');

    Route::prefix('tokens')->name('tokens.')->group(function () {
        Route::get('/', [PersonalAccessTokenController::class, 'index'])->name('index');
        Route::delete('/{token}', [PersonalAccessTokenController::class, 'destroy'])->name('destroy');
    });
});

Route::post('/tokens', [PersonalAccessTokenController::class, 'store'])
    ->name('tokens.store')
    ->middleware(ThrottleRequests::with(maxAttempts: 1, decayMinutes: 1));
