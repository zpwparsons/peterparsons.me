<?php

namespace App\Filters;

use App\Http\Requests\Api\Articles\ArticleIndexRequest;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class ArticleTagFilter
{
    public function __construct(public ArticleIndexRequest $request)
    {
        //
    }

    public function handle(Builder $query, Closure $next)
    {
        return $next($query)
            ->when($this->request->has('tag'), fn (Builder $query) => (
                $query->whereHas('tags', fn (Builder $subQuery) => (
                    $subQuery->where('name', $this->request->tag)
                ))
            ));
    }
}
