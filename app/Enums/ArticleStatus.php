<?php

namespace App\Enums;

enum ArticleStatus: int
{
    case Draft = 0;
    case Published = 1;

    public static function options(): array
    {
        return array_column(self::cases(), 'name');
    }
}
