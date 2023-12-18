<?php

use App\Models\Tool;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;

test('it can update a tool', function () {
    $user = User::factory()->create();

    $tool = Tool::factory()->create();

    actingAs($user)
        ->putJson(route('api:tools:update', $tool), [
            'category' => 'Warp',
            'description' => 'Rust-based terminal with AI built in.',
        ])
        ->assertNoContent();

    assertDatabaseHas(Tool::class, [
        'id' => $tool->id,
        'category' => 'Warp',
        'description' => 'Rust-based terminal with AI built in.',
    ]);
});

test('the category must be a string', function () {
    $user = User::factory()->create();

    $tool = Tool::factory()->create();

    actingAs($user)
        ->putJson(route('api:tools:update', $tool), [
            'category' => 1,
        ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The category field must be a string.',
        ]);
});

test('the description must be a string', function () {
    $user = User::factory()->create();

    $tool = Tool::factory()->create();

    actingAs($user)
        ->putJson(route('api:tools:update', $tool), [
            'description' => 1,
        ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The description field must be a string.',
        ]);
});

test('the category must not be longer than 100 characters', function () {
    $user = User::factory()->create();

    $tool = Tool::factory()->create();

    actingAs($user)
        ->putJson(route('api:tools:update', $tool), [
            'category' => str_repeat('a', 101),
        ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The category field must not be greater than 100 characters.',
        ]);
});

test('the description must not be longer than 10000 characters', function () {
    $user = User::factory()->create();

    $tool = Tool::factory()->create();

    actingAs($user)
        ->putJson(route('api:tools:update', $tool), [
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

    $tool = Tool::factory()->create();

    actingAs($user)
        ->putJson(route('api:tools:update', $tool), [
            'category' => $existingTool->category,
        ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The category has already been taken.',
        ]);
});

test('the unique check is ignored for the current tool', function () {
    $user = User::factory()->create();

    $tool = Tool::factory()->create();

    actingAs($user)
        ->putJson(route('api:tools:update', $tool), [
            'category' => $tool->category,
        ])
        ->assertNoContent();
});

test('unauthorized users cannot update a tool', function () {
    $tool = Tool::factory()->create();

    $this->putJson(route('api:tools:update', $tool), [
        'category' => 'Warp',
    ])
        ->assertUnauthorized();
});
