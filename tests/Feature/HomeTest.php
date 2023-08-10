<?php

namespace Tests\Feature;

use App\Livewire\Pages\Home;
use Tests\TestCase;

class HomeTest extends TestCase
{
    /** @test **/
    public function it_can_display_the_home_page(): void
    {
        $this
            ->get(route('home'))
            ->assertOk()
            ->assertSeeLivewire(Home::class)
            ->assertSee('Who the hell am I?');
    }
}
