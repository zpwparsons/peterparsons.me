<?php

namespace App\Livewire\Articles;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Article extends Component
{
    public function render(): View
    {
        return view('livewire.articles.article');
    }
}
