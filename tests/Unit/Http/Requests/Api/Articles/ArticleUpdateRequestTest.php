<?php

use App\Enums\ArticleStatus;
use App\Http\Requests\ArticleUpdateRequest;
use App\Models\Article;
use Illuminate\Validation\Rule;

use function PHPUnit\Framework\assertEquals;

it('has the correct rules', function () {
    $request = new ArticleUpdateRequest();

    $article = Article::factory()->create();

    $request->setRouteResolver(function () use ($request, $article) {
        $route = Route::getRoutes()->match($request);
        $route->setParameter('article', $article);

        return $route;
    });

    $rules = [
        'title' => [
            'sometimes',
            'string',
            'max:255',
            Rule::unique(Article::class, 'title')
                ->ignore($article),
        ],
        'excerpt' => [
            'sometimes',
            'string',
            'max:255',
        ],
        'content' => [
            'sometimes',
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
