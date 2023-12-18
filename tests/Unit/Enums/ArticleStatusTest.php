<?php

use App\Enums\ArticleStatus;

use function PHPUnit\Framework\assertSame;

it('can get the available options', function () {
    $options = [
        0 => ArticleStatus::Draft->name,
        1 => ArticleStatus::Published->name,
    ];

    assertSame($options, ArticleStatus::options());
});
