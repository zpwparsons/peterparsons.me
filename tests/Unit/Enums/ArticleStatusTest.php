<?php

use App\Enums\ArticleStatus;

it('can get the available options', function () {
    $options = [
        0 => ArticleStatus::Draft->name,
        1 => ArticleStatus::Published->name,
    ];

    self::assertSame($options, ArticleStatus::options());
});
