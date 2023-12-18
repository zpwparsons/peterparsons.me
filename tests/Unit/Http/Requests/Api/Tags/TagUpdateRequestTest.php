<?php

use App\Http\Requests\Api\Tags\TagUpdateRequest;
use App\Models\Tag;
use Illuminate\Validation\Rule;

use function PHPUnit\Framework\assertEquals;

it('has the correct rules', function () {
    $request = new TagUpdateRequest();

    $tag = Tag::factory()->create();

    $request->setRouteResolver(function () use ($request, $tag) {
        $route = Route::getRoutes()->match($request);
        $route->setParameter('tag', $tag);

        return $route;
    });

    $rules = [
        'name' => [
            'required',
            'string',
            'max:50',
            Rule::unique(Tag::class, 'name')
                ->ignore($tag),
        ],
    ];

    assertEquals($rules, $request->rules());
});
