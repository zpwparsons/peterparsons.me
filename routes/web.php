<?php

use App\Livewire\Articles\ShowArticle;
use App\Livewire\Articles\ListArticles;
use App\Livewire\Home;
use App\Livewire\Uses;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');

Route::prefix('articles')->name('articles:')->group(function () {
    Route::get('/', ListArticles::class)->name('list');
    Route::get('/{article:slug}', ShowArticle::class)->name('show');
});

Route::get('uses', Uses::class)->name('uses');
