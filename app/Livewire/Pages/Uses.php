<?php

namespace App\Livewire\Pages;

use App\Models\Tool;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Uses extends Component
{
    public Collection $tools;

    public function mount(): void
    {
        $this->tools = Tool::all(['category', 'description']);
    }

    public function render(): View
    {
        return view('livewire.pages.uses');
    }
}
