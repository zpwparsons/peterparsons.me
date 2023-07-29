<?php

use App\Livewire\Articles\Article;
use App\Livewire\Articles\ArticleListing;
use App\Livewire\Home;
use App\Livewire\Uses;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');

Route::prefix('articles')->name('articles:')->group(function () {
    Route::get('/', ArticleListing::class)->name('index');
    Route::get('/slug', Article::class)->name('show');
});

Route::get('uses', Uses::class)->name('uses');
