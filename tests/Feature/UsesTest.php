<?php

namespace Tests\Feature;

use App\Livewire\Pages\Uses;
use Tests\TestCase;

class UsesTest extends TestCase
{
    /** @test **/
    public function it_can_display_the_uses_page(): void
    {
        $this
            ->get(route('uses'))
            ->assertOk()
            ->assertSeeLivewire(Uses::class);
    }
}
