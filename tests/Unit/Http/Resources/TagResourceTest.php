<?php

use App\Http\Resources\ArticleResource;
use App\Http\Resources\TagResource;
use App\Models\Tag;

use function PHPUnit\Framework\assertSame;

it('has the correct format', function () {
    $tag = Tag::factory()->create();

    $resource = (TagResource::make($tag))
        ->response()
        ->getData(true);

    assertSame([
        'slug' => $tag->slug,
        'name' => $tag->name,
        'created_at' => $tag->created_at->toJson(),
        'updated_at' => $tag->updated_at->toJson(),
    ], $resource);
});

it('includes the articles when loaded', function () {
    $tag = Tag::factory()->create();

    $resource = (TagResource::make($tag->loadMissing('articles')))
        ->jsonSerialize();

    assertSame(ArticleResource::class, $resource['articles']->collects);
});
