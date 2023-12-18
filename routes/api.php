<?php

use App\Http\Controllers\Api\ArticlesController;
use Illuminate\Support\Facades\Route;

Route::prefix('articles')->name('articles:')->group(function () {
    Route::get('/', [ArticlesController::class, 'index'])->name('index');
});
