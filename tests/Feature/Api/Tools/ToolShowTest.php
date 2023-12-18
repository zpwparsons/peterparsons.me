<?php

use App\Models\Tool;

it('can get a specified tool', function () {
    $tool = Tool::factory()->create();

    $this
        ->getJson(route('api:tools:show', $tool))
        ->assertOk()
        ->assertExactJson([
            'slug' => $tool->slug,
            'category' => $tool->category,
            'description' => $tool->description,
            'created_at' => $tool->created_at->toJson(),
            'updated_at' => $tool->updated_at->toJson(),
        ]);
});
