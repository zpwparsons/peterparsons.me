<?php

namespace Tests\Unit\Models;

use App\Models\Article;
use Illuminate\Support\Str;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    /** @test **/
    public function it_has_the_correct_fillable_attributes(): void
    {
        $attributes = [
            'title',
            'content',
        ];

        self::assertSame($attributes, (new Article())->getFillable());
    }

    /** @test **/
    public function it_has_the_correct_route_key_name(): void
    {
        self::assertSame('slug', (new Article())->getRouteKeyName());
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
    public function it_can_get_the_formatted_content(): void
    {
        $article = Article::factory()->create([
            'content' => '# Article Title',
        ]);

        self::assertStringContainsString('<h1>Article Title</h1>', $article->formatted_content);
    }
}
