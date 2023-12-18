<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int $limit
 * @property string $order_by
 * @property string $order_dir
 * @property string $search
 */
class TagIndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'limit' => ['nullable', 'integer', 'gte:1'],
            'order_by' => ['nullable', 'in:name,created_at'],
            'order_dir' => ['nullable', 'in:asc,desc'],
            'search' => ['nullable', 'string'],
        ];
    }

    protected function passedValidation(): void
    {
        $this->setDefaultOrderBy();

        $this->setDefaultOrderDir();

        $this->setDefaultLimit();
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
