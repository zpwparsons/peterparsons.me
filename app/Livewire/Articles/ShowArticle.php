<?php

namespace App\Livewire\Articles;

use App\Models\Article;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ShowArticle extends Component
{
    public Article $article;

    public function render(): View
    {
        return view('livewire.articles.show-article')
            ->title($this->article->title);
    }
}
