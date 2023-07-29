<?php

namespace App\Livewire\Articles;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class ArticleListing extends Component
{
    public array $articles = [
        [
            'title' => 'Build Your Own Template Engine in PHP - Rendering &amp; Echo',
            'url'   => 'slug',
            'date'  => '14 Jun 2023',
            'tags'  => ['php'],
        ],
        [
            'title' => 'Write a Lexer in PHP with Lexical',
            'url'   => 'slug',
            'date'  => '7 Jun 2023',
            'tags'  => ['laravel', 'php', 'javascript'],
        ],
        [
            'title' => 'Build Your Own Service Container in PHP - Minimal Container',
            'url'   => 'slug',
            'date'  => '27 May 2023',
            'tags'  => ['javascript'],
        ],
    ];

    public function render(): View
    {
        return view('livewire.articles.article-listing');
    }
}
