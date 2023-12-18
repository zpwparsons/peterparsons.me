<?php

use App\Http\Controllers\Api\ArticlesController;
use App\Http\Controllers\TagsController;
use Illuminate\Support\Facades\Route;

Route::prefix('articles')->name('articles:')->group(function () {
    Route::get('/', [ArticlesController::class, 'index'])->name('index');
    Route::get('/{article}', [ArticlesController::class, 'show'])->name('show');
});

Route::prefix('tags')->name('tags:')->group(function () {
    Route::get('/', [TagsController::class, 'index'])->name('index');
    Route::get('/{tag}', [TagsController::class, 'show'])->name('show');
});
