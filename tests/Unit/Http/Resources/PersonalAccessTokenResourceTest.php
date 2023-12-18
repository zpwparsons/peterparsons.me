<?php

use App\Http\Resources\PersonalAccessTokenResource;
use App\Models\User;
use function PHPUnit\Framework\assertSame;

it('has the correct format', function () {
    $user = User::factory()->create();

    $token = $user->createToken('test')->accessToken;

    $resource = (PersonalAccessTokenResource::make($token))
        ->response()
        ->getData(true);

    assertSame([
        'id' => $token->id,
        'name' => $token->name,
        'last_used_at' => $token->last_used_at?->toJson(),
        'expires_at' => $token->expires_at?->toJson(),
        'created_at' => $token->created_at->toJson(),
        'updated_at' => $token->updated_at->toJson(),
    ], $resource);
});
