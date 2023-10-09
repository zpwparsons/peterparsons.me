<?php

namespace Tests\Unit\Models;

use App\Enums\ArticleStatus;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Support\Str;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    /** @test **/
    public function it_has_the_correct_fillable_attributes(): void
    {
        $attributes = [
            'title',
            'excerpt',
            'content',
            'status',
            'published_at',
        ];

        self::assertSame($attributes, (new Article())->getFillable());
    }

    /** @test **/
    public function it_has_the_correct_casted_attributes(): void
    {
        $attributes = [
            'id' => 'int',
            'status' => ArticleStatus::class,
            'published_at' => 'datetime',
        ];

        self::assertSame($attributes, (new Article())->getCasts());
    }

    /** @test **/
    public function it_sets_the_slug_on_save(): void
    {
        $article = Article::factory()->create(['slug' => null]);

        self::assertSame(Str::slug($article->title), $article->slug);

        $article->update(['title' => 'Article Title']);

        self::assertSame('article-title', $article->slug);
    }

    /** @test **/
    public function it_has_the_correct_route_key_name(): void
    {
        self::assertSame('slug', (new Article())->getRouteKeyName());
    }

    /** @test **/
    public function it_can_check_if_it_is_published(): void
    {
        $article = Article::factory()->create(['published_at' => null]);

        self::assertFalse($article->isPublished());

        $article = Article::factory()->create(['published_at' => now()]);

        self::assertTrue($article->isPublished());
    }

    /** @test **/
    public function it_has_a_scope_to_get_published_tags(): void
    {
        Article::factory()
            ->count(3)
            ->sequence(
                ['status' => ArticleStatus::Published],
                ['status' => ArticleStatus::Draft],
                ['status' => ArticleStatus::Published],
            )
            ->create();

        self::assertCount(2, Article::published()->get());
    }

    /** @test **/
    public function it_belongs_to_many_articles(): void
    {
        $article = Article::factory()
            ->has(Tag::factory()->count(3))
            ->create();

        self::assertInstanceOf(Tag::class, $article->tags->first());
    }

    /** @test **/
    public function it_can_get_the_formatted_content(): void
    {
        $article = Article::factory()->create(['content' => '# Article Content']);

        self::assertStringContainsString(
            '<h1>Article Content</h1>',
            $article->formatted_content
        );
    }

    /** @test **/
    public function it_can_get_the_formatted_published_date(): void
    {
        $date = now();

        $article = Article::factory()->create(['published_at' => $date]);

        self::assertSame($date->format('M d, Y'), $article->formatted_published_date);

        $article = Article::factory()->create(['published_at' => null]);

        self::assertNull($article->formatted_published_date);
    }
}
