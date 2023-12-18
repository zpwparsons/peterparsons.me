<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\SlugOptions;

class Tool extends Model
{
    use HasFactory;
    use HasSlug;

    protected $fillable = [
        'category',
        'description',
    ];

    protected function formattedDescription(): Attribute
    {
        return Attribute::get(fn () => Markdown::convert($this->description)->getContent());
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('category')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(50);
    }
}
