<?php

use App\Http\Requests\Api\Articles\ArticleIndexRequest;

use function PHPUnit\Framework\assertSame;

it('has the correct rules', function () {
    $request = new ArticleIndexRequest();

    $rules = [
        'limit' => [
            'nullable',
            'integer',
            'gte:1',
        ],
        'order_by' => [
            'nullable',
            'in:title,created_at',
        ],
        'order_dir' => [
            'nullable',
            'in:asc,desc',
        ],
        'search' => [
            'nullable',
            'string',
        ],
    ];

    assertSame($rules, $request->rules());
});

it('sets the default limit', function () {
    $request = new ArticleIndexRequest();

    (new ReflectionMethod($request::class, 'passedValidation'))->invoke($request);

    assertSame(10, $request->limit);
});

it('sets the default order by field', function () {
    $request = new ArticleIndexRequest();

    (new ReflectionMethod($request::class, 'passedValidation'))->invoke($request);

    assertSame('created_at', $request->order_by);
});

it('sets the default order direction', function () {
    $request = new ArticleIndexRequest();

    (new ReflectionMethod($request::class, 'passedValidation'))->invoke($request);

    assertSame('desc', $request->order_dir);
});
