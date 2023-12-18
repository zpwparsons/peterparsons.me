<?php

use App\Models\Tool;
use Illuminate\Support\Str;

use function PHPUnit\Framework\assertSame;
use function PHPUnit\Framework\assertStringContainsString;

it('has the correct fillable attributes', function () {
    $attributes = [
        'category',
        'description',
    ];

    assertSame($attributes, (new Tool())->getFillable());
});

it('sets the slug on save', function () {
    $tool = Tool::factory()->create(['slug' => null]);

    assertSame(Str::slug($tool->category), $tool->slug);

    $tool->update(['category' => 'Category Name']);

    assertSame('category-name', $tool->slug);
});

it('has the correct route key name', function () {
    assertSame('slug', (new Tool())->getRouteKeyName());
});

it('can get the formatted description', function () {
    $tool = Tool::factory()->create(['description' => '# Tool Description']);

    assertStringContainsString(
        '<h1>Tool Description</h1>',
        $tool->formatted_description
    );
});
