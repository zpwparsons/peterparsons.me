<?php

use App\Models\Article;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseEmpty;

test('it can delete a article', function () {
    $user = User::factory()->create();

    $article = Article::factory()->create();

    actingAs($user)
        ->deleteJson(route('api:articles:destroy', $article))
        ->assertNoContent();

    assertDatabaseEmpty(Article::class);
});

test('unauthorized users cannot delete a article', function () {
    $article = Article::factory()->create();

    $this->putJson(route('api:articles:destroy', $article))
        ->assertUnauthorized();
});
