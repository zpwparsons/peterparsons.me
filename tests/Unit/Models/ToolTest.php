<?php

use App\Models\Tool;
use function PHPUnit\Framework\assertSame;
use function PHPUnit\Framework\assertStringContainsString;

it('has the correct fillable attributes', function () {
    $attributes = [
        'category',
        'description',
    ];

    assertSame($attributes, (new Tool())->getFillable());
});

it('can get the formatted description', function () {
    $tool = Tool::factory()->create(['description' => '# Tool Description']);

    assertStringContainsString(
        '<h1>Tool Description</h1>',
        $tool->formatted_description
    );
});
