<?php

namespace App\Http\Requests\Api\Tools;

use Illuminate\Foundation\Http\FormRequest;

class ToolIndexRequest extends FormRequest
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
                'in:category,created_at',
            ],
            'order_dir' => [
                'nullable',
                'in:asc,desc',
            ],
            'search' => [
                'nullable',
                'string',
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
