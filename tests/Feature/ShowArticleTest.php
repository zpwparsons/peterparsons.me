<?php

use App\Livewire\Pages\Articles\ShowArticle;
use App\Models\Article;

it('can get a specified article', function () {
    $article = Article::factory()->create();

    $this
        ->get(route('articles.show', $article))
        ->assertOk()
        ->assertSeeLivewire(ShowArticle::class)
        ->assertSee($article->title);
});
