<?php

use App\Models\Tag;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseEmpty;

test('it can delete a tag', function () {
    $user = User::factory()->create();

    $tag = Tag::factory()->create();

    actingAs($user)
        ->deleteJson(route('api:tags:destroy', $tag))
        ->assertNoContent();

    assertDatabaseEmpty(Tag::class);
});

test('unauthorized users cannot delete a tag', function () {
    $tag = Tag::factory()->create();

    $this->putJson(route('api:tags:destroy', $tag))
        ->assertUnauthorized();
});
