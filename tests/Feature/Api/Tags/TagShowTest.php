<?php

use App\Models\Article;
use App\Models\Tag;

it('can get a specified tag', function () {
    $tag = Tag::factory()
        ->has(Article::factory())
        ->create();

    $this
        ->getJson(route('api:tags:show', $tag))
        ->assertOk()
        ->assertExactJson([
            'slug' => $tag->slug,
            'name' => $tag->name,
            'created_at' => $tag->created_at->toJson(),
            'updated_at' => $tag->updated_at->toJson(),
            'articles' => [
                [
                    'slug' => $tag->articles->get(0)->slug,
                    'title' => $tag->articles->get(0)->title,
                    'excerpt' => $tag->articles->get(0)->excerpt,
                    'content' => $tag->articles->get(0)->content,
                    'status' => $tag->articles->get(0)->status->name,
                    'published_at' => $tag->articles->get(0)->published_at->toJson(),
                    'created_at' => $tag->articles->get(0)->created_at->toJson(),
                    'updated_at' => $tag->articles->get(0)->updated_at->toJson(),
                ],
            ],
        ]);
});
