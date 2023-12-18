<?php

use App\Models\User;

use function Pest\Laravel\actingAs;

it("it can get a listing of the user's personal access tokens", function () {
    $user = User::factory()->create();

    $token1 = $user->createToken('token_1')->accessToken;
    $token2 = $user->createToken('token_2')->accessToken;
    $token3 = $user->createToken('token_3')->accessToken;

    actingAs($user)
        ->getJson(route('api.tokens.index'))
        ->assertOk()
        ->assertJson([
            [
                'id' => $token1->id,
                'name' => $token1->name,
                'last_used_at' => $token1->last_used_at?->toJson(),
                'expires_at' => $token1->expires_at?->toJson(),
                'created_at' => $token1->created_at->toJson(),
                'updated_at' => $token1->updated_at->toJson(),
            ],
            [
                'id' => $token2->id,
                'name' => $token2->name,
                'last_used_at' => $token2->last_used_at?->toJson(),
                'expires_at' => $token2->expires_at?->toJson(),
                'created_at' => $token2->created_at->toJson(),
                'updated_at' => $token2->updated_at->toJson(),
            ],
            [
                'id' => $token3->id,
                'name' => $token3->name,
                'last_used_at' => $token3->last_used_at?->toJson(),
                'expires_at' => $token3->expires_at?->toJson(),
                'created_at' => $token3->created_at->toJson(),
                'updated_at' => $token3->updated_at->toJson(),
            ],
        ]);
});

test('unauthenticated users cannot get a listing of personal access tokens', function () {
    $this
        ->getJson(route('api.tokens.index'))
        ->assertUnauthorized();
});
