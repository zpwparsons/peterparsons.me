<?php

use App\Models\Tag;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

use function Pest\Laravel\actingAs;
use function PHPUnit\Framework\assertSame;

test('it can update a tag', function () {
    $user = User::factory()->create();

    $tag = Tag::factory()->create();

    actingAs($user)
        ->putJson(route('api.tags.update', $tag), [
            'name' => 'Laravel',
        ])
        ->assertNoContent();

    assertSame('Laravel', Tag::sole()->name);
});

test('the name is required', function () {
    $user = User::factory()->create();

    $tag = Tag::factory()->create();

    actingAs($user)
        ->putJson(route('api.tags.update', $tag))
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The name field is required.',
        ]);
});

test('the name must be a string', function () {
    $user = User::factory()->create();

    $tag = Tag::factory()->create();

    actingAs($user)
        ->putJson(route('api.tags.update', $tag), [
            'name' => 1,
        ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The name field must be a string.',
        ]);
});

test('the name must not be longer than 50 characters', function () {
    $user = User::factory()->create();

    $tag = Tag::factory()->create();

    actingAs($user)
        ->putJson(route('api.tags.update', $tag), [
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

    $tag = Tag::factory()->create();

    actingAs($user)
        ->putJson(route('api.tags.update', $tag), [
            'name' => $existingTag->name,
        ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The name has already been taken.',
        ]);
});

test('the unique check is ignored for the current tag', function () {
    $user = User::factory()->create();

    $tag = Tag::factory()->create();

    actingAs($user)
        ->putJson(route('api.tags.update', $tag), [
            'name' => $tag->name,
        ])
        ->assertNoContent();
});

test('unauthorized users cannot update a tag', function () {
    $tag = Tag::factory()->create();

    $this->putJson(route('api.tags.update', $tag), [
        'name' => 'Laravel',
    ])
        ->assertUnauthorized();
});
