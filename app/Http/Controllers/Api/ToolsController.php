<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Tools\ToolIndexRequest;
use App\Http\Requests\Api\Tools\ToolStoreRequest;
use App\Http\Requests\Api\Tools\ToolUpdateRequest;
use App\Http\Resources\ToolResource;
use App\Models\Tool;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

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

    public function store(ToolStoreRequest $request): ToolResource
    {
        $tool = Tool::create($request->validated());

        return ToolResource::make($tool);
    }

    public function show(Tool $tool): ToolResource
    {
        return ToolResource::make($tool);
    }

    public function update(ToolUpdateRequest $request, Tool $tool): Response
    {
        $tool->update($request->validated());

        return response()->noContent();
    }

    public function destroy(Tool $tool): Response
    {
        $tool->delete();

        return response()->noContent();
    }
}
