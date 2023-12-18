<?php

use App\Http\Requests\Api\Tools\ToolStoreRequest;
use App\Models\Tool;
use Illuminate\Validation\Rule;
use function PHPUnit\Framework\assertEquals;

it('has the correct rules', function () {
    $request = new ToolStoreRequest();

    $rules = [
        'category' => [
            'required',
            'string',
            'max:100',
            Rule::unique(Tool::class, 'category'),
        ],
        'description' => [
            'required',
            'string',
            'max:10_000',
        ],
    ];

    assertEquals($rules, $request->rules());
});
