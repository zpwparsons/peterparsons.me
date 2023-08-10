<?php

namespace Tests\Feature;

use App\Livewire\Pages\Articles\ListArticles;
use Tests\TestCase;

class ListArticlesTest extends TestCase
{
    /** @test **/
    public function it_can_display_the_page_for_listing_articles(): void
    {
        $this
            ->get(route('articles:list'))
            ->assertOk()
            ->assertSeeLivewire(ListArticles::class)
            ->assertSee('Articles');
    }
}
