<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\Tools\ToolIndexRequest;
use App\Http\Resources\ToolResource;
use App\Models\Tool;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ToolsController extends Controller
{
    public function index(ToolIndexRequest $request): AnonymousResourceCollection
    {
        $tools = Tool::query()
            ->when($request->filled('search'), fn (Builder $query) => (
                $query->where('category', 'like', "%{$request->search}%")
            ))
            ->orderBy($request->order_by, $request->order_dir)
            ->fastPaginate($request->limit);

        return ToolResource::collection($tools);
    }

    public function show(Tool $tool): ToolResource
    {
        return ToolResource::make($tool);
    }
}
