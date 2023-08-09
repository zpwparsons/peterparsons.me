<?php

namespace App\Livewire\Components\App;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Search extends Component
{
    public bool $showSearch = false;

    public function render(): View
    {
        return view('livewire.components.app.search');
    }
}
