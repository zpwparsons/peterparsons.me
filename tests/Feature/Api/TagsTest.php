<?php

use App\Models\Tag;
use function PHPUnit\Framework\assertSame;

uses()->group('api');

it('can get a listing of tags', function () {
    $tags = Tag::factory()
        ->count(3)
        ->create();

    $this
        ->getJson(route('api:tags:index'))
        ->assertOk()
        ->assertJson([
            'data' => [
                [
                    'slug' => $tags->get(0)->slug,
                    'name' => $tags->get(0)->name,
                    'created_at' => $tags->get(0)->created_at->toJson(),
                    'updated_at' => $tags->get(0)->updated_at->toJson(),
                ],
                [
                    'slug' => $tags->get(1)->slug,
                    'name' => $tags->get(1)->name,
                    'created_at' => $tags->get(1)->created_at->toJson(),
                    'updated_at' => $tags->get(1)->updated_at->toJson(),
                ],
                [
                    'slug' => $tags->get(2)->slug,
                    'name' => $tags->get(2)->name,
                    'created_at' => $tags->get(2)->created_at->toJson(),
                    'updated_at' => $tags->get(2)->updated_at->toJson(),
                ],
            ],
        ]);
});

it('can search the listing of tags', function () {
    $tags = Tag::factory()
        ->count(3)
        ->sequence(
            ['name' => 'AlpineJs'],
            ['name' => 'Bash'],
            ['name' => 'Closure'],
        )
        ->create();

    $this
        ->getJson(route('api:tags:index', [
            'search' => 'sure',
        ]))
        ->assertOk()
        ->assertJson([
            'data' => [
                ['name' => $tags->get(2)->name],
            ],
        ]);
});

it('can order the tags by name in ascending order', function () {
    $tags = Tag::factory()
        ->count(3)
        ->sequence(
            ['name' => 'Bash'],
            ['name' => 'AlpineJs'],
            ['name' => 'Closure'],
        )
        ->create();

    $this
        ->getJson(route('api:tags:index', [
            'order_by' => 'name',
            'order_dir' => 'asc',
        ]))
        ->assertOk()
        ->assertJson([
            'data' => [
                ['name' => $tags->get(1)->name],
                ['name' => $tags->get(0)->name],
                ['name' => $tags->get(2)->name],
            ],
        ]);
});

it('can order the tags by name in descending order', function () {
    $tags = Tag::factory()
        ->count(3)
        ->sequence(
            ['name' => 'Bash'],
            ['name' => 'AlpineJs'],
            ['name' => 'Closure'],
        )
        ->create();

    $this
        ->getJson(route('api:tags:index', [
            'order_by' => 'name',
            'order_dir' => 'desc',
        ]))
        ->assertOk()
        ->assertJson([
            'data' => [
                ['name' => $tags->get(2)->name],
                ['name' => $tags->get(0)->name],
                ['name' => $tags->get(1)->name],
            ],
        ]);
});

it('can order the tags by created date in ascending order', function () {
    $tags = Tag::factory()
        ->count(3)
        ->sequence(
            ['created_at' => now()->subDay()],
            ['created_at' => now()],
            ['created_at' => now()->subWeek()],
        )
        ->create();

    $this
        ->getJson(route('api:tags:index', [
            'order_by' => 'created_at',
            'order_dir' => 'asc',
        ]))
        ->assertOk()
        ->assertJson([
            'data' => [
                ['slug' => $tags->get(2)->slug],
                ['slug' => $tags->get(0)->slug],
                ['slug' => $tags->get(1)->slug],
            ],
        ]);
});

it('can order the tags by created date in descending order', function () {
    $tags = Tag::factory()
        ->count(3)
        ->sequence(
            ['created_at' => now()->subDay()],
            ['created_at' => now()],
            ['created_at' => now()->subWeek()],
        )
        ->create();

    $this
        ->getJson(route('api:tags:index', [
            'order_by' => 'created_at',
            'order_dir' => 'desc',
        ]))
        ->assertOk()
        ->assertJson([
            'data' => [
                ['slug' => $tags->get(1)->slug],
                ['slug' => $tags->get(0)->slug],
                ['slug' => $tags->get(2)->slug],
            ],
        ]);
});

it('can limit the number of tags listed', function () {
    Tag::factory()
        ->count(3)
        ->create();

    $this
        ->getJson(route('api:tags:index', [
            'limit' => 1,
        ]))
        ->assertOk()
        ->assertJsonCount(1, 'data');
});

it('can paginate the listing of tags', function () {
    Tag::factory()
        ->count(10)
        ->create();

    $expectedPaginationLinks = [
        'first' => route('api:tags:index', ['page' => 1]),
        'last' => route('api:tags:index', ['page' => 10]),
        'prev' => route('api:tags:index', ['page' => 1]),
        'next' => route('api:tags:index', ['page' => 3]),
    ];

    $response = $this
        ->getJson(route('api:tags:index', [
            'limit' => 1,
            'page' => 2,
        ]))
        ->assertOk();

    assertSame($expectedPaginationLinks, $response->json('links'));
});

it('can get a specified tag', function () {
    $tag = Tag::factory()->create();

    $this
        ->getJson(route('api:tags:show', $tag))
        ->assertOk()
        ->assertExactJson([
            'slug' => $tag->slug,
            'name' => $tag->name,
            'created_at' => $tag->created_at->toJson(),
            'updated_at' => $tag->updated_at->toJson(),
        ]);
});
