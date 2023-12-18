<?php

use App\Http\Controllers\Api\ArticlesController;
use App\Http\Controllers\Api\TagsController;
use App\Http\Controllers\Api\ToolsController;
use Illuminate\Support\Facades\Route;

Route::prefix('articles')->name('articles:')->group(function () {
    Route::get('/', [ArticlesController::class, 'index'])->name('index');
    Route::get('/{article}', [ArticlesController::class, 'show'])->name('show');
});

Route::prefix('tags')->name('tags:')->group(function () {
    Route::get('/', [TagsController::class, 'index'])->name('index');
    Route::get('/{tag}', [TagsController::class, 'show'])->name('show');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/', [TagsController::class, 'store'])->name('store');
        Route::put('/{tag}', [TagsController::class, 'store'])->name('update');
        Route::delete('/{tag}', [TagsController::class, 'destroy'])->name('destroy');
    });
});

Route::prefix('tools')->name('tools:')->group(function () {
    Route::get('/', [ToolsController::class, 'index'])->name('index');
    Route::get('/{tool}', [ToolsController::class, 'show'])->name('show');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/', [ToolsController::class, 'store'])->name('store');
        Route::put('/{tool}', [ToolsController::class, 'store'])->name('update');
        Route::delete('/{tool}', [ToolsController::class, 'destroy'])->name('destroy');
    });
});
