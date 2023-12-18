<?php

use App\Models\Tool;

it('has the correct fillable attributes', function () {
    $attributes = [
        'category',
        'description',
    ];

    self::assertSame($attributes, (new Tool())->getFillable());
});

it('can get the formatted description', function () {
    $tool = Tool::factory()->create(['description' => '# Tool Description']);

    self::assertStringContainsString(
        '<h1>Tool Description</h1>',
        $tool->formatted_description
    );
});
