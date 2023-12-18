<?php

use App\Models\User;

use function Pest\Laravel\actingAs;
use function PHPUnit\Framework\assertCount;

it("can delete the user's specified token", function () {
    $user = User::factory()->create();

    $token = $user->createToken('testing')->accessToken;

    actingAs($user)
        ->deleteJson(route('api.tokens.destroy', $token->id))
        ->assertNoContent();

    assertCount(0, $user->tokens);
});

test('a user cannot delete an access token that belongs to a different user', function () {
    $differentUser = User::factory()->create();

    $token = $differentUser->createToken('testing')->accessToken;

    $user = User::factory()->create();

    actingAs($user)
        ->deleteJson(route('api.tokens.destroy', $token->id))
        ->assertForbidden();
});

test('unauthenticated users cannot delete a specified personal access token', function () {
    $this
        ->deleteJson(route('api.tokens.destroy', 1))
        ->assertUnauthorized();
});
