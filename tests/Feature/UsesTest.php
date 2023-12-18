<?php

use App\Livewire\Pages\Uses;

it('can display the uses page', function () {
    $this
        ->get(route('uses'))
        ->assertOk()
        ->assertSeeLivewire(Uses::class);
});
