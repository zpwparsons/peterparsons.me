<?php

namespace App\Http\Requests\Api\Tools;

use App\Models\Tool;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ToolStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
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
    }
}
