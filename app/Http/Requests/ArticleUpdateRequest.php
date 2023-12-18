<?php

namespace App\Http\Requests;

use App\Enums\ArticleStatus;
use App\Models\Article;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property string $title
 * @property string $excerpt
 * @property string $content
 * @property mixed $status
 * @property mixed $published_at
 */
class ArticleUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => [
                'sometimes',
                'string',
                'max:255',
                Rule::unique(Article::class, 'title')
                    ->ignore($this->route('article')),
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
                Rule::requiredIf($this->status === ArticleStatus::Published->value),
                'date',
            ],
        ];
    }
}
