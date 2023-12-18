<?php

use App\Enums\ArticleStatus;
use App\Models\Article;
use App\Models\Tag;

use App\Models\User;
use function Pest\Laravel\actingAs;
use function PHPUnit\Framework\assertSame;

uses()->group('api');

it('can get a listing of articles', function () {
    $articles = Article::factory()
        ->count(3)
        ->create();

    $user = User::factory()->create();

    actingAs($user)
        ->getJson(route('api.articles.index'))
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

    $user = User::factory()->create();

    actingAs($user)
        ->getJson(route('api.articles.index', [
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

    $user = User::factory()->create();

    actingAs($user)
        ->getJson(route('api.articles.index', [
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

    $user = User::factory()->create();

    actingAs($user)
        ->getJson(route('api.articles.index', [
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

    $user = User::factory()->create();

    actingAs($user)
        ->getJson(route('api.articles.index', [
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

    $user = User::factory()->create();

    actingAs($user)
        ->getJson(route('api.articles.index', [
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

    $user = User::factory()->create();

    actingAs($user)
        ->getJson(route('api.articles.index', [
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
        'first' => route('api.articles.index', ['page' => 1]),
        'last' => route('api.articles.index', ['page' => 10]),
        'prev' => route('api.articles.index', ['page' => 1]),
        'next' => route('api.articles.index', ['page' => 3]),
    ];

    $user = User::factory()->create();

    $response = actingAs($user)
        ->getJson(route('api.articles.index', [
            'limit' => 1,
            'page' => 2,
        ]))
        ->assertOk();

    assertSame($expectedPaginationLinks, $response->json('links'));
});

it('can filter articles that have a specified status', function () {
    $articles = Article::factory()
        ->count(3)
        ->sequence(
            ['status' => ArticleStatus::Draft],
            ['status' => ArticleStatus::Published],
            ['status' => ArticleStatus::Draft],
        )
        ->create();

    $user = User::factory()->create();

    actingAs($user)
        ->getJson(route('api.articles.index', [
            'status' => ArticleStatus::Draft,
        ]))
        ->assertOk()
        ->assertJsonCount(2, 'data')
        ->assertJson([
            'data' => [
                ['slug' => $articles->get(0)->slug],
                ['slug' => $articles->get(2)->slug],
            ],
        ]);
});

it('can filter articles that have a specified tag', function () {
    $articles = Article::factory()
        ->count(3)
        ->create();

    $tags = Tag::factory()
        ->count(2)
        ->sequence(
            ['name' => 'PHP'],
            ['name' => 'Rust'],
        )
        ->create();

    $articles->get(0)->tags()->attach($tags->get(0)); // Article 1: PHP
    $articles->get(1)->tags()->attach($tags);         // Article 2: PHP and Rust
    $articles->get(2)->tags()->attach($tags->get(1)); // Article 3: Rust

    $user = User::factory()->create();

    actingAs($user)
        ->getJson(route('api.articles.index', [
            'tag' => 'PHP',
        ]))
        ->assertOk()
        ->assertJsonCount(2, 'data')
        ->assertJson([
            'data' => [
                ['slug' => $articles->get(0)->slug],
                ['slug' => $articles->get(1)->slug],
            ],
        ]);
});

test('unauthenticated users cannot get a listing of articles', function () {
    $this
        ->getJson(route('api.articles.index'))
        ->assertUnauthorized();
});
