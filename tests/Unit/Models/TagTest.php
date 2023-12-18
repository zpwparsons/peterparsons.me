<?php

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Support\Str;

use function PHPUnit\Framework\assertInstanceOf;
use function PHPUnit\Framework\assertSame;

it('has the correct fillable attributes', function () {
    $attributes = [
        'name',
    ];

    assertSame($attributes, (new Tag())->getFillable());
});

it('sets the slug on save', function () {
    $tag = Tag::factory()->create(['slug' => null]);

    assertSame(Str::slug($tag->name), $tag->slug);

    $tag->update(['name' => 'Tag Name']);

    assertSame('tag-name', $tag->slug);
});

it('has the correct route key name', function () {
    assertSame('slug', (new Tag())->getRouteKeyName());
});

it('belongs to many articles', function () {
    $tags = Tag::factory()
        ->has(Article::factory()->count(3))
        ->create();

    assertInstanceOf(Article::class, $tags->articles->first());
});
