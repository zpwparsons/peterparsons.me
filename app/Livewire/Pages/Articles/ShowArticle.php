<?php

namespace App\Livewire\Pages\Articles;

use App\Models\Article;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ShowArticle extends Component
{
    public Article $article;

    public function render(): View
    {
        return view('livewire.pages.articles.show-article')
            ->title($this->article->title);
    }
}
