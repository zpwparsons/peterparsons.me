<?php

namespace App\Filters;

use App\Enums\ArticleStatus;
use App\Http\Requests\Api\Articles\ArticleIndexRequest;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class ArticleStatusFilter
{
    public function __construct(public ArticleIndexRequest $request)
    {
        //
    }

    public function handle(Builder $query, Closure $next)
    {
        return $next($query)
            ->when($this->request->has('status'), fn (Builder $query) => (
                $query->where('status', $this->request->enum('status', ArticleStatus::class))
            ));
    }
}
