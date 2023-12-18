<?php

namespace Tests\Feature\Api;

use App\Models\Article;
use Tests\TestCase;

class ArticlesTest extends TestCase
{
    /** @test **/
    public function it_can_get_a_listing_of_articles(): void
    {
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
    }

    /** @test **/
    public function it_can_search_the_listing_of_articles(): void
    {
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
    }

    /** @test **/
    public function it_can_order_the_articles_by_title_in_ascending_order(): void
    {
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
                'order_by'  => 'title',
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
    }

    /** @test **/
    public function it_can_order_the_articles_by_title_in_descending_order(): void
    {
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
                'order_by'  => 'title',
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
    }

    /** @test **/
    public function it_can_order_the_articles_by_created_date_in_ascending_order(): void
    {
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
                'order_by'  => 'created_at',
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
    }

    /** @test **/
    public function it_can_order_the_articles_by_created_date_in_descending_order(): void
    {
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
                'order_by'  => 'created_at',
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
    }

    /** @test **/
    public function it_can_limit_the_number_of_articles_listed(): void
    {
        Article::factory()
            ->count(3)
            ->create();

        $this
            ->getJson(route('api:articles:index', [
                'limit' => 1,
            ]))
            ->assertOk()
            ->assertJsonCount(1, 'data');
    }

    /** @test **/
    public function it_can_paginate_the_listing_of_articles(): void
    {
        Article::factory()
            ->count(10)
            ->create();

        $expectedPaginationLinks = [
            'first' => route('api:articles:index', ['page' => 1]),
            'last'  => route('api:articles:index', ['page' => 10]),
            'prev'  => route('api:articles:index', ['page' => 1]),
            'next'  => route('api:articles:index', ['page' => 3]),
        ];

        $response = $this
            ->getJson(route('api:articles:index', [
                'limit' => 1,
                'page'  => 2,
            ]))
            ->assertOk();

        self::assertSame($expectedPaginationLinks, $response->json('links'));
    }
}
