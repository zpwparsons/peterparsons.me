<?php

namespace App\Filters;

use App\Http\Requests\Api\Articles\ArticleIndexRequest;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class ArticleTitleFilter
{
    public function __construct(public ArticleIndexRequest $request)
    {
        //
    }

    public function handle(Builder $query, Closure $next)
    {
        return $next($query)
            ->when($this->request->has('search'), fn (Builder $query) => (
                $query->where('title', 'like', "%{$this->request->search}%")
            ));
    }
}
