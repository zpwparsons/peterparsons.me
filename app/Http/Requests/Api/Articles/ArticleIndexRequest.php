<?php

namespace App\Http\Requests\Api\Articles;

use App\Enums\ArticleStatus;
use App\Models\Tag;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property int $limit
 * @property string $order_by
 * @property string $order_dir
 * @property string $search
 * @property mixed $status
 * @property string $tag
 */
class ArticleIndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'limit' => [
                'nullable',
                'integer',
                'gte:1',
            ],
            'order_by' => [
                'nullable',
                'in:title,created_at',
            ],
            'order_dir' => [
                'nullable',
                'in:asc,desc',
            ],
            'search' => [
                'nullable',
                'string',
            ],
            'status' => [
                'sometimes',
                Rule::enum(ArticleStatus::class),
            ],
            'tag' => [
                'sometimes',
                Rule::exists(Tag::class, 'name'),
            ],
        ];
    }

    protected function passedValidation(): void
    {
        $this->setDefaultLimit();

        $this->setDefaultOrderBy();

        $this->setDefaultOrderDir();
    }

    protected function setDefaultLimit(): void
    {
        $this->mergeIfMissing(['limit' => 10]);
    }

    protected function setDefaultOrderBy(): void
    {
        $this->mergeIfMissing(['order_by' => 'created_at']);
    }

    protected function setDefaultOrderDir(): void
    {
        $this->mergeIfMissing(['order_dir' => 'desc']);
    }
}
