<?php

namespace App\Livewire\Components\App;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;
use Spatie\SiteSearch\Search as SiteSearch;

class Search extends Component
{
    public bool $showSearch = false;

    public string $query = '';

    public function getResults(): Collection
    {
        if (strlen($this->query) < 3) {
            return collect();
        }

        return SiteSearch::onIndex($this->indexName())
            ->query($this->query)
            ->limit(10)
            ->get()
            ->hits;
    }

    public function render(): View
    {
        return view('livewire.components.app.search')
            ->with('results', $this->getResults());
    }

    protected function indexName(): string
    {
        return 'articles';
    }
}
