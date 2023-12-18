<?php

use App\Enums\ArticleStatus;
use App\Models\Article;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;

test('it can create a published article', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->postJson(route('api:articles:store'), [
            'title' => 'Building Better Code',
            'excerpt' => 'Importance of clean code.',
            'content' => 'Writing understandable code is essential to creating maintainable apps.',
            'status' => ArticleStatus::Published,
            'published_at' => now(),
        ])
        ->assertCreated();

    assertDatabaseHas(Article::class, [
        'title' => 'Building Better Code',
        'excerpt' => 'Importance of clean code.',
        'content' => 'Writing understandable code is essential to creating maintainable apps.',
        'status' => ArticleStatus::Published->value,
        'published_at' => now(),
    ]);
});

test('it can create a draft article', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->postJson(route('api:articles:store'), [
            'title' => 'Building Better Code',
            'excerpt' => 'Importance of clean code.',
            'content' => 'Writing understandable code is essential to creating maintainable apps.',
        ])
        ->assertCreated();

    assertDatabaseHas(Article::class, [
        'title' => 'Building Better Code',
        'excerpt' => 'Importance of clean code.',
        'content' => 'Writing understandable code is essential to creating maintainable apps.',
        'status' => ArticleStatus::Draft->value,
        'published_at' => null,
    ]);
});

test('the title is required', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->postJson(route('api:articles:store'), [
            'excerpt' => 'Importance of clean code.',
            'content' => 'Writing understandable code is essential to creating maintainable apps.',
        ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The title field is required.',
        ]);
});

test('the excerpt is required', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->postJson(route('api:articles:store'), [
            'title' => 'Building Better Code',
            'content' => 'Writing understandable code is essential to creating maintainable apps.',
        ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The excerpt field is required.',
        ]);
});

test('the content is required', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->postJson(route('api:articles:store'), [
            'title' => 'Building Better Code',
            'excerpt' => 'Importance of clean code.',
        ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The content field is required.',
        ]);
});

test('the title must be a string', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->postJson(route('api:articles:store'), [
            'title' => 1,
            'excerpt' => 'Importance of clean code.',
            'content' => 'Writing understandable code is essential to creating maintainable apps.',
        ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The title field must be a string.',
        ]);
});

test('the excerpt must be a string', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->postJson(route('api:articles:store'), [
            'title' => 'Building Better Code',
            'excerpt' => 1,
            'content' => 'Writing understandable code is essential to creating maintainable apps.',
        ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The excerpt field must be a string.',
        ]);
});

test('the content must be a string', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->postJson(route('api:articles:store'), [
            'title' => 'Building Better Code',
            'excerpt' => 'Importance of clean code.',
            'content' => 1,
        ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The content field must be a string.',
        ]);
});

test('the title must not be longer than 255 characters', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->postJson(route('api:articles:store'), [
            'title' => str_repeat('a', 256),
            'excerpt' => 'Importance of clean code.',
            'content' => 'Writing understandable code is essential to creating maintainable apps.',
        ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The title field must not be greater than 255 characters.',
        ]);
});

test('the excerpt must not be longer than 255 characters', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->postJson(route('api:articles:store'), [
            'title' => 'Building Better Code',
            'excerpt' => str_repeat('a', 256),
            'content' => 'Writing understandable code is essential to creating maintainable apps.',
        ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The excerpt field must not be greater than 255 characters.',
        ]);
});

test('the title must be unique', function () {
    $user = User::factory()->create();

    $existingArticle = Article::factory()->create();

    actingAs($user)
        ->postJson(route('api:articles:store'), [
            'title' => $existingArticle->title,
            'excerpt' => 'Importance of clean code.',
            'content' => 'Writing understandable code is essential to creating maintainable apps.',
        ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The title has already been taken.',
        ]);
});

test('the status must be a valid status', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->postJson(route('api:articles:store'), [
            'title' => 'Building Better Code',
            'excerpt' => 'Importance of clean code.',
            'content' => 'Writing understandable code is essential to creating maintainable apps.',
            'status' => 'invalid',
            'published_at' => now(),
        ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The selected status is invalid.',
        ]);
});

test('the published date is required when the status is published', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->postJson(route('api:articles:store'), [
            'title' => 'Building Better Code',
            'excerpt' => 'Importance of clean code.',
            'content' => 'Writing understandable code is essential to creating maintainable apps.',
            'status' => ArticleStatus::Published,
        ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The published at field is required.',
        ]);
});

test('unauthorized users cannot create a article', function () {
    $this->postJson(route('api:articles:store'), [
        'title' => 'Building Better Code',
        'excerpt' => 'Importance of clean code.',
        'content' => 'Writing understandable code is essential to creating maintainable apps.',
    ])
        ->assertUnauthorized();
});
