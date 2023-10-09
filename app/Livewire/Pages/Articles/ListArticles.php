<?php

namespace App\Livewire\Pages\Articles;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * @property Tag|null $selectedTag
 */
class ListArticles extends Component
{
    use WithPagination;

    public function getSelectedTagProperty(Request $request): ?Tag
    {
        return $request->query('tag')
            ? Tag::firstWhere('slug', $request->query('tag'))
            : null;
    }

    public function render(Request $request): View
    {
        $articles = Article::query()
            ->with('tags')
            ->when($request->query('tag'), function (Builder $query) use ($request) {
                return $query->whereRelation('tags', 'slug', $request->query('tag'));
            })
            ->published()
            ->fastPaginate();

        return view('livewire.pages.articles.list-articles')
            ->with('articles', $articles);
    }
}
