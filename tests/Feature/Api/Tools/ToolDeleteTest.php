<?php

use App\Models\Tool;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseEmpty;

test('it can delete a tool', function () {
    $user = User::factory()->create();

    $tool = Tool::factory()->create();

    actingAs($user)
        ->deleteJson(route('api:tools:destroy', $tool))
        ->assertNoContent();

    assertDatabaseEmpty(Tool::class);
});

test('unauthorized users cannot delete a tool', function () {
    $tool = Tool::factory()->create();

    $this->putJson(route('api:tools:destroy', $tool))
        ->assertUnauthorized();
});
