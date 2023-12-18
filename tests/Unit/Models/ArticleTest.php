<?php

use App\Enums\ArticleStatus;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Support\Str;

it('has the correct fillable attributes', function () {
    $attributes = [
        'title',
        'excerpt',
        'content',
        'status',
        'published_at',
    ];

    self::assertSame($attributes, (new Article())->getFillable());
});

it('has the correct casted attributes', function () {
    $attributes = [
        'id' => 'int',
        'status' => ArticleStatus::class,
        'published_at' => 'datetime',
    ];

    self::assertSame($attributes, (new Article())->getCasts());
});

it('sets the slug on save', function () {
    $article = Article::factory()->create(['slug' => null]);

    self::assertSame(Str::slug($article->title), $article->slug);

    $article->update(['title' => 'Article Title']);

    self::assertSame('article-title', $article->slug);
});

it('has the correct route key name', function () {
    self::assertSame('slug', (new Article())->getRouteKeyName());
});

it('can check if it is published', function () {
    $article = Article::factory()->create(['published_at' => null]);

    self::assertFalse($article->isPublished());

    $article = Article::factory()->create(['published_at' => now()]);

    self::assertTrue($article->isPublished());
});

it('has a scope to get published tags', function () {
    Article::factory()
        ->count(3)
        ->sequence(
            ['status' => ArticleStatus::Published],
            ['status' => ArticleStatus::Draft],
            ['status' => ArticleStatus::Published],
        )
        ->create();

    self::assertCount(2, Article::published()->get());
});

it('belongs to many articles', function () {
    $article = Article::factory()
        ->has(Tag::factory()->count(3))
        ->create();

    self::assertInstanceOf(Tag::class, $article->tags->first());
});

it('can get the formatted content', function () {
    $article = Article::factory()->create(['content' => '# Article Content']);

    self::assertStringContainsString(
        '<h1>Article Content</h1>',
        $article->formatted_content
    );
});

it('can get the formatted published date', function () {
    $date = now();

    $article = Article::factory()->create(['published_at' => $date]);

    self::assertSame($date->format('M d, Y'), $article->formatted_published_date);

    $article = Article::factory()->create(['published_at' => null]);

    self::assertNull($article->formatted_published_date);
});
