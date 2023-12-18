<?php

use App\Models\Tool;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;

test('it can create a tool', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->postJson(route('api:tools:store'), [
            'category' => 'Warp',
            'description' => 'Rust-based terminal with AI built in.',
        ])
        ->assertCreated();

    assertDatabaseHas(Tool::class, [
        'category' => 'Warp',
        'description' => 'Rust-based terminal with AI built in.',
    ]);
});

test('the category must be a string', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->postJson(route('api:tools:store'), [
            'category' => 1,
            'description' => 'Rust-based terminal with AI built in.',
        ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The category field must be a string.',
        ]);
});

test('the description must be a string', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->postJson(route('api:tools:store'), [
            'category' => 'Warp',
            'description' => 1,
        ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The description field must be a string.',
        ]);
});

test('the category must not be longer than 100 characters', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->postJson(route('api:tools:store'), [
            'category' => str_repeat('a', 101),
            'description' => 'Rust-based terminal with AI built in.',
        ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The category field must not be greater than 100 characters.',
        ]);
});

test('the description must not be longer than 10000 characters', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->postJson(route('api:tools:store'), [
            'category' => 'Warp',
            'description' => str_repeat('a', 10001),
        ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The description field must not be greater than 10000 characters.',
        ]);
});

test('the category must be unique', function () {
    $user = User::factory()->create();

    $existingTool = Tool::factory()->create();

    actingAs($user)
        ->postJson(route('api:tools:store'), [
            'category' => $existingTool->category,
            'description' => 'Rust-based terminal with AI built in.',
        ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The category has already been taken.',
        ]);
});

test('unauthorized users cannot update a tool', function () {
    $this->postJson(route('api:tools:store'), [
        'category' => 'Warp',
        'description' => 'Rust-based terminal with AI built in.',
    ])
        ->assertUnauthorized();
});
