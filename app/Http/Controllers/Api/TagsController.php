<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Tags\TagIndexRequest;
use App\Http\Requests\Api\Tags\TagStoreRequest;
use App\Http\Requests\Api\Tags\TagUpdateRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class TagsController extends Controller
{
    public function index(TagIndexRequest $request): AnonymousResourceCollection
    {
        $tags = Tag::query()
            ->when($request->filled('search'), fn (Builder $query) => (
                $query->where('name', 'like', "%{$request->search}%")
            ))
            ->orderBy($request->order_by, $request->order_dir)
            ->fastPaginate($request->limit);

        return TagResource::collection($tags);
    }

    public function store(TagStoreRequest $request): TagResource
    {
        $tag = Tag::create($request->validated());

        return TagResource::make($tag);
    }

    public function show(Tag $tag): TagResource
    {
        $tag->load('articles');

        return TagResource::make($tag);
    }

    public function update(TagUpdateRequest $request, Tag $tag): TagResource
    {
        $tag->update($request->validated());

        return TagResource::make($tag);
    }

    public function destroy(Tag $tag): Response
    {
        $tag->delete();

        return response()->noContent();
    }
}
