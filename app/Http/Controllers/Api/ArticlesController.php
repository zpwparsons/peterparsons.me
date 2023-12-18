<?php

namespace App\Http\Controllers\Api;

use App\Filters\ArticleStatusFilter;
use App\Filters\ArticleTagFilter;
use App\Filters\ArticleTitleFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Articles\ArticleIndexRequest;
use App\Http\Requests\Api\Articles\ArticleStoreRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Pipeline;

class ArticlesController extends Controller
{
    public function index(ArticleIndexRequest $request): AnonymousResourceCollection
    {
        $articles = Pipeline::send(Article::query())
            ->through([
                ArticleTitleFilter::class,
                ArticleStatusFilter::class,
                ArticleTagFilter::class,
            ])
            ->thenReturn()
            ->orderBy($request->order_by, $request->order_dir)
            ->fastPaginate($request->limit);

        return ArticleResource::collection($articles);
    }

    public function store(ArticleStoreRequest $request): ArticleResource
    {
        $article = Article::create($request->validated());

        return ArticleResource::make($article);
    }

    public function show(Article $article): ArticleResource
    {
        return ArticleResource::make($article);
    }

    public function update(ArticleUpdateRequest $request, Article $article): Response
    {
        $article->update($request->validated());

        return response()->noContent();
    }

    public function destroy(Article $article): Response
    {
        $article->delete();

        return response()->noContent();
    }
}
