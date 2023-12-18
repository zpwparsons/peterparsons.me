<?php

namespace App\Http\Requests\Api\Tools;

use App\Models\Tool;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ToolUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'category' => [
                'sometimes',
                'string',
                'max:100',
                Rule::unique(Tool::class, 'category')
                    ->ignore($this->route('tool')),
            ],
            'description' => [
                'sometimes',
                'string',
                'max:10_000',
            ],
        ];
    }
}
