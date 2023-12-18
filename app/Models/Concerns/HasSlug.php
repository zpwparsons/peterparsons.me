<?php

namespace App\Models\Concerns;

use Spatie\Sluggable\HasSlug as HasSpatieSlug;

trait HasSlug
{
    use HasSpatieSlug;

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
