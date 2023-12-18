<?php

use App\Http\Requests\Api\ArticleIndexRequest;
use function PHPUnit\Framework\assertSame;

test('it has the correct rules', function () {
    $request = new ArticleIndexRequest();

    $rules = [
        'limit' => ['nullable', 'integer', 'gte:1'],
        'order_by' => ['nullable', 'in:title,created_at'],
        'order_dir' => ['nullable', 'in:asc,desc'],
        'search' => ['nullable', 'string'],
    ];

    assertSame($rules, $request->rules());
});
