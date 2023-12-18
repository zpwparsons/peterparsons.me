<?php

use App\Models\Article;

it('can get a specified article', function () {
    $article = Article::factory()->create();

    $this
        ->getJson(route('api:articles:show', $article))
        ->assertOk()
        ->assertExactJson([
            'slug' => $article->slug,
            'title' => $article->title,
            'excerpt' => $article->excerpt,
            'content' => $article->content,
            'status' => $article->status->name,
            'published_at' => $article->published_at->toJson(),
            'created_at' => $article->created_at->toJson(),
            'updated_at' => $article->updated_at->toJson(),
        ]);
});
