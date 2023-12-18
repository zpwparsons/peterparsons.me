<?php

use App\Http\Resources\ArticleResource;
use App\Models\Article;

use function PHPUnit\Framework\assertSame;

it('has the correct format', function () {
    $article = Article::factory()->create();

    $resource = (ArticleResource::make($article))
        ->response()
        ->getData(true);

    assertSame([
        'slug' => $article->slug,
        'title' => $article->title,
        'excerpt' => $article->excerpt,
        'content' => $article->content,
        'status' => $article->status->name,
        'published_at' => $article->published_at->toJson(),
        'created_at' => $article->created_at->toJson(),
        'updated_at' => $article->updated_at->toJson(),
    ], $resource);
});
