<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ArticleIndexRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ArticlesController extends Controller
{
    public function index(ArticleIndexRequest $request): AnonymousResourceCollection
    {
        $articles = Article::query()
            ->when($request->filled('search'), fn (Builder $query) => (
                $query->where('title', 'like', "%{$request->search}%")
            ))
            ->orderBy($request->order_by, $request->order_dir)
            ->fastPaginate($request->limit);

        return ArticleResource::collection($articles);
    }
}
