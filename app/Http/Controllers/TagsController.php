<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagIndexRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

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

    public function show(Tag $tag): TagResource
    {
        return TagResource::make($tag);
    }
}
