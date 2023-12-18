<?php

use App\Http\Requests\Api\Tags\TagStoreRequest;
use App\Models\Tag;
use Illuminate\Validation\Rule;

use function PHPUnit\Framework\assertEquals;

it('has the correct rules', function () {
    $request = new TagStoreRequest();

    $rules = [
        'name' => [
            'required',
            'string',
            'max:50',
            Rule::unique(Tag::class, 'name'),
        ],
    ];

    assertEquals($rules, $request->rules());
});
