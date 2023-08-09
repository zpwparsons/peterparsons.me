<?php

namespace App\Livewire\Pages\Articles;

use App\Models\Article;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ListArticles extends Component
{
    public Collection $articles;

    public function mount(): void
    {
        $this->articles = Article::all();
    }

    public function render(): View
    {
        return view('livewire.pages.articles.list-articles');
    }
}
