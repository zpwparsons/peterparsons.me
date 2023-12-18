<?php

use App\Livewire\Pages\Home;

it('can display the home page', function () {
    $this
        ->get(route('home'))
        ->assertOk()
        ->assertSeeLivewire(Home::class)
        ->assertSee('Who the hell am I?');
});
