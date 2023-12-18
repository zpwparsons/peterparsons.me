<?php

use App\Models\Tool;
use App\Models\User;
use function Pest\Laravel\actingAs;

it('can get a specified tool', function () {
    $tool = Tool::factory()->create();

    $user = User::factory()->create();

    actingAs($user)
        ->getJson(route('api.tools.show', $tool))
        ->assertOk()
        ->assertExactJson([
            'slug' => $tool->slug,
            'category' => $tool->category,
            'description' => $tool->description,
            'created_at' => $tool->created_at->toJson(),
            'updated_at' => $tool->updated_at->toJson(),
        ]);
});

test('unauthenticated users cannot get a specified tool', function () {
    $tool = Tool::factory()->create();

    $this
        ->getJson(route('api.tools.index', $tool))
        ->assertUnauthorized();
});
