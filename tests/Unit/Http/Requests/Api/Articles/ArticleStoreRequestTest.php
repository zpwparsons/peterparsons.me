<?php

use App\Enums\ArticleStatus;
use App\Http\Requests\Api\Articles\ArticleStoreRequest;
use App\Models\Article;
use Illuminate\Validation\Rule;

use function PHPUnit\Framework\assertEquals;

it('has the correct rules', function () {
    $request = new ArticleStoreRequest();

    $rules = [
        'title' => [
            'required',
            'string',
            'max:255',
            Rule::unique(Article::class, 'title'),
        ],
        'excerpt' => [
            'required',
            'string',
            'max:255',
        ],
        'content' => [
            'required',
            'string',
        ],
        'status' => [
            'sometimes',
            'nullable',
            Rule::enum(ArticleStatus::class),
        ],
        'published_at' => [
            Rule::requiredIf($request->status === ArticleStatus::Published->value),
            'date',
        ],
    ];

    assertEquals($rules, $request->rules());
});
