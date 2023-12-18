<?php

use App\Http\Requests\Api\Tools\ToolUpdateRequest;
use App\Models\Tool;
use Illuminate\Validation\Rule;

use function PHPUnit\Framework\assertEquals;

it('has the correct rules', function () {
    $request = new ToolUpdateRequest();

    $tool = Tool::factory()->create();

    $request->setRouteResolver(function () use ($request, $tool) {
        $route = Route::getRoutes()->match($request);
        $route->setParameter('tool', $tool);

        return $route;
    });

    $rules = [
        'category' => [
            'sometimes',
            'string',
            'max:100',
            Rule::unique(Tool::class, 'category')
                ->ignore($tool),
        ],
        'description' => [
            'sometimes',
            'string',
            'max:10000',
        ],
    ];

    assertEquals($rules, $request->rules());
});
