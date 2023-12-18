<?php

use App\Models\Article;

use function PHPUnit\Framework\assertSame;

uses()->group('api');

it('can get a listing of articles', function () {
    $articles = Article::factory()
        ->count(3)
        ->create();

    $this
        ->getJson(route('api:articles:index'))
        ->assertOk()
        ->assertJson([
            'data' => [
                [
                    'slug' => $articles->get(0)->slug,
                    'title' => $articles->get(0)->title,
                    'excerpt' => $articles->get(0)->excerpt,
                    'content' => $articles->get(0)->content,
                    'status' => $articles->get(0)->status->name,
                    'published_at' => $articles->get(0)->published_at->toJson(),
                    'created_at' => $articles->get(0)->created_at->toJson(),
                    'updated_at' => $articles->get(0)->updated_at->toJson(),
                ],
                [
                    'slug' => $articles->get(1)->slug,
                    'title' => $articles->get(1)->title,
                    'excerpt' => $articles->get(1)->excerpt,
                    'content' => $articles->get(1)->content,
                    'status' => $articles->get(1)->status->name,
                    'published_at' => $articles->get(1)->published_at->toJson(),
                    'created_at' => $articles->get(1)->created_at->toJson(),
                    'updated_at' => $articles->get(1)->updated_at->toJson(),
                ],
                [
                    'slug' => $articles->get(2)->slug,
                    'title' => $articles->get(2)->title,
                    'excerpt' => $articles->get(2)->excerpt,
                    'content' => $articles->get(2)->content,
                    'status' => $articles->get(2)->status->name,
                    'published_at' => $articles->get(2)->published_at->toJson(),
                    'created_at' => $articles->get(2)->created_at->toJson(),
                    'updated_at' => $articles->get(2)->updated_at->toJson(),
                ],
            ],
        ]);
});

it('can search the listing of articles', function () {
    $articles = Article::factory()
        ->count(3)
        ->sequence(
            ['title' => 'A Journey into Programming Paradigms'],
            ['title' => 'Building Better Code: A Comprehensive Guide'],
            ['title' => 'Crafting Creative Content for Digital Platforms'],
        )
        ->create();

    $this
        ->getJson(route('api:articles:index', [
            'search' => 'code',
        ]))
        ->assertOk()
        ->assertJson([
            'data' => [
                ['title' => $articles->get(1)->title],
            ],
        ]);
});

it('can order the articles by title in ascending order', function () {
    $articles = Article::factory()
        ->count(3)
        ->sequence(
            ['title' => 'Building Better Code: A Comprehensive Guide'],
            ['title' => 'A Journey into Programming Paradigms'],
            ['title' => 'Crafting Creative Content for Digital Platforms'],
        )
        ->create();

    $this
        ->getJson(route('api:articles:index', [
            'order_by' => 'title',
            'order_dir' => 'asc',
        ]))
        ->assertOk()
        ->assertJson([
            'data' => [
                ['title' => $articles->get(1)->title],
                ['title' => $articles->get(0)->title],
                ['title' => $articles->get(2)->title],
            ],
        ]);
});

it('can order the articles by title in descending order', function () {
    $articles = Article::factory()
        ->count(3)
        ->sequence(
            ['title' => 'Building Better Code: A Comprehensive Guide'],
            ['title' => 'A Journey into Programming Paradigms'],
            ['title' => 'Crafting Creative Content for Digital Platforms'],
        )
        ->create();

    $this
        ->getJson(route('api:articles:index', [
            'order_by' => 'title',
            'order_dir' => 'desc',
        ]))
        ->assertOk()
        ->assertJson([
            'data' => [
                ['title' => $articles->get(2)->title],
                ['title' => $articles->get(0)->title],
                ['title' => $articles->get(1)->title],
            ],
        ]);
});

it('can order the articles by created date in ascending order', function () {
    $articles = Article::factory()
        ->count(3)
        ->sequence(
            ['created_at' => now()->subDay()],
            ['created_at' => now()],
            ['created_at' => now()->subWeek()],
        )
        ->create();

    $this
        ->getJson(route('api:articles:index', [
            'order_by' => 'created_at',
            'order_dir' => 'asc',
        ]))
        ->assertOk()
        ->assertJson([
            'data' => [
                ['slug' => $articles->get(2)->slug],
                ['slug' => $articles->get(0)->slug],
                ['slug' => $articles->get(1)->slug],
            ],
        ]);
});

it('can order the articles by created date in descending order', function () {
    $articles = Article::factory()
        ->count(3)
        ->sequence(
            ['created_at' => now()->subDay()],
            ['created_at' => now()],
            ['created_at' => now()->subWeek()],
        )
        ->create();

    $this
        ->getJson(route('api:articles:index', [
            'order_by' => 'created_at',
            'order_dir' => 'desc',
        ]))
        ->assertOk()
        ->assertJson([
            'data' => [
                ['slug' => $articles->get(1)->slug],
                ['slug' => $articles->get(0)->slug],
                ['slug' => $articles->get(2)->slug],
            ],
        ]);
});

it('can limit the number of articles listed', function () {
    Article::factory()
        ->count(3)
        ->create();

    $this
        ->getJson(route('api:articles:index', [
            'limit' => 1,
        ]))
        ->assertOk()
        ->assertJsonCount(1, 'data');
});

it('can paginate the listing of articles', function () {
    Article::factory()
        ->count(10)
        ->create();

    $expectedPaginationLinks = [
        'first' => route('api:articles:index', ['page' => 1]),
        'last' => route('api:articles:index', ['page' => 10]),
        'prev' => route('api:articles:index', ['page' => 1]),
        'next' => route('api:articles:index', ['page' => 3]),
    ];

    $response = $this
        ->getJson(route('api:articles:index', [
            'limit' => 1,
            'page' => 2,
        ]))
        ->assertOk();

    assertSame($expectedPaginationLinks, $response->json('links'));
});

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
