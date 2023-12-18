<?php

use App\Enums\ArticleStatus;
use App\Models\Article;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;

test('it can update a published article', function () {
    $user = User::factory()->create();

    $article = Article::factory()->create();

    actingAs($user)
        ->putJson(route('api:articles:update', $article), [
            'title' => 'Building Better Code',
            'excerpt' => 'Importance of clean code.',
            'content' => 'Writing understandable code is essential to creating maintainable apps.',
            'status' => ArticleStatus::Published,
            'published_at' => now(),
        ])
        ->assertNoContent();

    assertDatabaseHas(Article::class, [
        'id' => $article->id,
        'title' => 'Building Better Code',
        'excerpt' => 'Importance of clean code.',
        'content' => 'Writing understandable code is essential to creating maintainable apps.',
        'status' => ArticleStatus::Published->value,
        'published_at' => now(),
    ]);
});

test('the title must be a string', function () {
    $user = User::factory()->create();

    $article = Article::factory()->create();

    actingAs($user)
        ->putJson(route('api:articles:update', $article), [
            'title' => 1,
        ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The title field must be a string.',
        ]);
});

test('the excerpt must be a string', function () {
    $user = User::factory()->create();

    $article = Article::factory()->create();

    actingAs($user)
        ->putJson(route('api:articles:update', $article), [
            'excerpt' => 1,
        ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The excerpt field must be a string.',
        ]);
});

test('the content must be a string', function () {
    $user = User::factory()->create();

    $article = Article::factory()->create();

    actingAs($user)
        ->putJson(route('api:articles:update', $article), [
            'content' => 1,
        ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The content field must be a string.',
        ]);
});

test('the title must not be longer than 255 characters', function () {
    $user = User::factory()->create();

    $article = Article::factory()->create();

    actingAs($user)
        ->putJson(route('api:articles:update', $article), [
            'title' => str_repeat('a', 256),
        ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The title field must not be greater than 255 characters.',
        ]);
});

test('the excerpt must not be longer than 255 characters', function () {
    $user = User::factory()->create();

    $article = Article::factory()->create();

    actingAs($user)
        ->putJson(route('api:articles:update', $article), [
            'excerpt' => str_repeat('a', 256),
        ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The excerpt field must not be greater than 255 characters.',
        ]);
});

test('the title must be unique', function () {
    $user = User::factory()->create();

    $existingArticle = Article::factory()->create();

    $article = Article::factory()->create();

    actingAs($user)
        ->putJson(route('api:articles:update', $article), [
            'title' => $existingArticle->title,
        ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The title has already been taken.',
        ]);
});

test('the status must be a valid status', function () {
    $user = User::factory()->create();

    $article = Article::factory()->create();

    actingAs($user)
        ->putJson(route('api:articles:update', $article), [
            'status' => 'invalid',
        ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The selected status is invalid.',
        ]);
});

test('the published date is required when the status is published', function () {
    $user = User::factory()->create();

    $article = Article::factory()->create();

    actingAs($user)
        ->putJson(route('api:articles:update', $article), [
            'status' => ArticleStatus::Published,
        ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJson([
            'message' => 'The published at field is required.',
        ]);
});

test('unauthorized users cannot update a article', function () {
    $article = Article::factory()->create();

    $this->putJson(route('api:articles:update', $article))
        ->assertUnauthorized();
});
