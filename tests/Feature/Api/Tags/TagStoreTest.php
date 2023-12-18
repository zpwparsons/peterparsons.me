<?php

use App\Models\Tag;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use function Pest\Laravel\actingAs;
use function PHPUnit\Framework\assertSame;

test('it can create a tag', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->postJson(route('api:tags:store'), [
            'name' => 'Laravel',
        ])
        ->assertCreated();

    assertSame('Laravel', Tag::sole()->name);
});

test('the name is required', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->postJson(route('api:tags:store'))
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The name field is required.',
        ]);
});

test('the name must be a string', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->postJson(route('api:tags:store'), [
            'name' => 1,
        ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The name field must be a string.',
        ]);
});

test('the name must not be longer than 50 characters', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->postJson(route('api:tags:store'), [
            'name' => str_repeat('a', 51),
        ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The name field must not be greater than 50 characters.',
        ]);
});

test('the name must be unique', function () {
    $user = User::factory()->create();

    $existingTag = Tag::factory()->create();

    actingAs($user)
        ->postJson(route('api:tags:store'), [
            'name' => $existingTag->name,
        ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The name has already been taken.',
        ]);
});

test('unauthorized users cannot create a tag', function () {
    $this->postJson(route('api:tags:store'), [
        'name' => 'Laravel',
    ])
        ->assertUnauthorized();
});
