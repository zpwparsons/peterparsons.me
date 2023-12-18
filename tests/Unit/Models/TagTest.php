<?php

use App\Models\Article;
use App\Models\Tag;

it('has the correct fillable attributes', function () {
    $attributes = [
        'name',
    ];

    self::assertSame($attributes, (new Tag())->getFillable());
});

it('has the correct route key name', function () {
    self::assertSame('slug', (new Tag())->getRouteKeyName());
});

it('belongs to many articles', function () {
    $tags = Tag::factory()
        ->has(Article::factory()->count(3))
        ->create();

    self::assertInstanceOf(Article::class, $tags->articles->first());
});
