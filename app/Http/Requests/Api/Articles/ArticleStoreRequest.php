<?php

namespace App\Http\Requests\Api\Articles;

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
class ArticleStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
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
                Rule::requiredIf($this->status === ArticleStatus::Published->value),
                'date',
            ],
        ];
    }
}
