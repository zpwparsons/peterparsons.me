<?php

use App\Models\Article;

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
                ['title' => $articles->get(0)->title],
                ['title' => $articles->get(1)->title],
                ['title' => $articles->get(2)->title],
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

    self::assertSame($expectedPaginationLinks, $response->json('links'));
});
