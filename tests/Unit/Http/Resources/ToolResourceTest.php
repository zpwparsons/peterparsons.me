<?php

use App\Http\Resources\ToolResource;
use App\Models\Tool;
use function PHPUnit\Framework\assertSame;

it('has the correct format', function () {
    $tool = Tool::factory()->create();

    $resource = (ToolResource::make($tool))
        ->response()
        ->getData(true);

    assertSame([
        'slug' => $tool->slug,
        'category' => $tool->category,
        'description' => $tool->description,
        'created_at' => $tool->created_at->toJson(),
        'updated_at' => $tool->updated_at->toJson(),
    ], $resource);
});
