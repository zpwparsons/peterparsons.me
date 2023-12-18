<?php

use App\Models\Tag;
use App\Models\Tool;
use function PHPUnit\Framework\assertSame;

uses()->group('api');

it('can get a listing of tools', function () {
    $tools = Tool::factory()
        ->count(3)
        ->create();

    $this
        ->getJson(route('api:tools:index'))
        ->assertOk()
        ->assertJson([
            'data' => [
                [
                    'slug' => $tools->get(0)->slug,
                    'category' => $tools->get(0)->category,
                    'description' => $tools->get(0)->description,
                    'created_at' => $tools->get(0)->created_at->toJson(),
                    'updated_at' => $tools->get(0)->updated_at->toJson(),
                ],
                [
                    'slug' => $tools->get(1)->slug,
                    'category' => $tools->get(1)->category,
                    'description' => $tools->get(1)->description,
                    'created_at' => $tools->get(1)->created_at->toJson(),
                    'updated_at' => $tools->get(1)->updated_at->toJson(),
                ],
                [
                    'slug' => $tools->get(2)->slug,
                    'category' => $tools->get(2)->category,
                    'description' => $tools->get(2)->description,
                    'created_at' => $tools->get(2)->created_at->toJson(),
                    'updated_at' => $tools->get(2)->updated_at->toJson(),
                ],
            ],
        ]);
});

it('can search the listing of tools', function () {
    $tools = Tool::factory()
        ->count(3)
        ->sequence(
            ['category' => 'CleanMyMac'],
            ['category' => 'PHPStorm'],
            ['category' => 'Warp'],
        )
        ->create();

    $this
        ->getJson(route('api:tools:index', [
            'search' => 'storm',
        ]))
        ->assertOk()
        ->assertJson([
            'data' => [
                ['category' => $tools->get(1)->category],
            ],
        ]);
});

it('can order the tools by name in ascending order', function () {
    $tools = Tool::factory()
        ->count(3)
        ->sequence(
            ['category' => 'Bash'],
            ['category' => 'AlpineJs'],
            ['category' => 'Closure'],
        )
        ->create();

    $this
        ->getJson(route('api:tools:index', [
            'order_by' => 'category',
            'order_dir' => 'asc',
        ]))
        ->assertOk()
        ->assertJson([
            'data' => [
                ['category' => $tools->get(1)->category],
                ['category' => $tools->get(0)->category],
                ['category' => $tools->get(2)->category],
            ],
        ]);
});

it('can order the tools by name in descending order', function () {
    $tools = Tool::factory()
        ->count(3)
        ->sequence(
            ['category' => 'Bash'],
            ['category' => 'AlpineJs'],
            ['category' => 'Closure'],
        )
        ->create();

    $this
        ->getJson(route('api:tools:index', [
            'order_by' => 'category',
            'order_dir' => 'desc',
        ]))
        ->assertOk()
        ->assertJson([
            'data' => [
                ['category' => $tools->get(2)->category],
                ['category' => $tools->get(0)->category],
                ['category' => $tools->get(1)->category],
            ],
        ]);
});

it('can order the tools by created date in ascending order', function () {
    $tools = Tool::factory()
        ->count(3)
        ->sequence(
            ['created_at' => now()->subDay()],
            ['created_at' => now()],
            ['created_at' => now()->subWeek()],
        )
        ->create();

    $this
        ->getJson(route('api:tools:index', [
            'order_by' => 'created_at',
            'order_dir' => 'asc',
        ]))
        ->assertOk()
        ->assertJson([
            'data' => [
                ['slug' => $tools->get(2)->slug],
                ['slug' => $tools->get(0)->slug],
                ['slug' => $tools->get(1)->slug],
            ],
        ]);
});

it('can order the tools by created date in descending order', function () {
    $tools = Tool::factory()
        ->count(3)
        ->sequence(
            ['created_at' => now()->subDay()],
            ['created_at' => now()],
            ['created_at' => now()->subWeek()],
        )
        ->create();

    $this
        ->getJson(route('api:tools:index', [
            'order_by' => 'created_at',
            'order_dir' => 'desc',
        ]))
        ->assertOk()
        ->assertJson([
            'data' => [
                ['slug' => $tools->get(1)->slug],
                ['slug' => $tools->get(0)->slug],
                ['slug' => $tools->get(2)->slug],
            ],
        ]);
});

it('can limit the number of tools listed', function () {
    Tool::factory()
        ->count(3)
        ->create();

    $this
        ->getJson(route('api:tools:index', [
            'limit' => 1,
        ]))
        ->assertOk()
        ->assertJsonCount(1, 'data');
});

it('can paginate the listing of tools', function () {
    Tool::factory()
        ->count(10)
        ->create();

    $expectedPaginationLinks = [
        'first' => route('api:tools:index', ['page' => 1]),
        'last' => route('api:tools:index', ['page' => 10]),
        'prev' => route('api:tools:index', ['page' => 1]),
        'next' => route('api:tools:index', ['page' => 3]),
    ];

    $response = $this
        ->getJson(route('api:tools:index', [
            'limit' => 1,
            'page' => 2,
        ]))
        ->assertOk();

    assertSame($expectedPaginationLinks, $response->json('links'));
});

it('can get a specified tool', function () {
    $tool = Tool::factory()->create();

    $this
        ->getJson(route('api:tools:show', $tool))
        ->assertOk()
        ->assertExactJson([
            'slug' => $tool->slug,
            'category' => $tool->category,
            'description' => $tool->description,
            'created_at' => $tool->created_at->toJson(),
            'updated_at' => $tool->updated_at->toJson(),
        ]);
});
