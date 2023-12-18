<?php

namespace App\Http\Requests\Api\Tags;

use App\Models\Tag;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TagUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique(Tag::class, 'name')
                    ->ignore($this->route('tag')),
            ],
        ];
    }
}
