<?php

namespace Tests\Unit\Models;

use App\Models\Article;
use App\Models\Tag;
use Tests\TestCase;

class TagTest extends TestCase
{
    /** @test **/
    public function it_has_the_correct_fillable_attributes(): void
    {
        $attributes = [
            'name',
        ];

        self::assertSame($attributes, (new Tag())->getFillable());
    }

    /** @test **/
    public function it_has_the_correct_route_key_name(): void
    {
        self::assertSame('slug', (new Tag())->getRouteKeyName());
    }

    /** @test **/
    public function it_belongs_to_many_articles(): void
    {
        $tags = Tag::factory()
            ->has(Article::factory()->count(3))
            ->create();

        self::assertInstanceOf(Article::class, $tags->articles->first());
    }
}
