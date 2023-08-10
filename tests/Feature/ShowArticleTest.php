<?php

namespace Tests\Feature;

use App\Livewire\Pages\Articles\ShowArticle;
use App\Models\Article;
use Tests\TestCase;

class ShowArticleTest extends TestCase
{
    /** @test **/
    public function it_can_get_a_specified_article(): void
    {
        $article = Article::factory()->create();

        $this
            ->get(route('articles:show', $article))
            ->assertOk()
            ->assertSeeLivewire(ShowArticle::class)
            ->assertSee($article->title);
    }
}
