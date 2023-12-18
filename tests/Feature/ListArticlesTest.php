<?php

use App\Livewire\Pages\Articles\ListArticles;

it('can display the page for listing articles', function () {
    $this
        ->get(route('articles:list'))
        ->assertOk()
        ->assertSeeLivewire(ListArticles::class)
        ->assertSee('Articles');
});
