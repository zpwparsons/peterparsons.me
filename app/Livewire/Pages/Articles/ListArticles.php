<?php

namespace App\Livewire\Pages\Articles;

use App\Models\Article;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class ListArticles extends Component
{
    use WithPagination;

    public function render(): View
    {
        $articles = Article::query()
            ->published()
            ->fastPaginate();

        return view('livewire.pages.articles.list-articles')
            ->with('articles', $articles);
    }
}
