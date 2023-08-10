<?php

namespace Tests\Unit\Models;

use App\Models\Tool;
use Tests\TestCase;

class ToolTest extends TestCase
{
    /** @test **/
    public function it_has_the_correct_fillable_attributes(): void
    {
        $attributes = [
            'category',
            'description',
        ];

        self::assertSame($attributes, (new Tool())->getFillable());
    }

    /** @test **/
    public function it_can_get_the_formatted_description(): void
    {
        $tool = Tool::factory()->create(['description' => '# Tool Description']);

        self::assertStringContainsString(
            '<h1>Tool Description</h1>',
            $tool->formatted_description
        );
    }
}
