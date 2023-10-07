<?php

namespace Tests\Unit\Enums;

use App\Enums\ArticleStatus;
use PHPUnit\Framework\TestCase;

class ArticleStatusTest extends TestCase
{
    /** @test **/
    public function it_can_get_the_available_options(): void
    {
        $options = [
            0 => ArticleStatus::Draft->name,
            1 => ArticleStatus::Published->name,
        ];

        self::assertSame($options, ArticleStatus::options());
    }
}
