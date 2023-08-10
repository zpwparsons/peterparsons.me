<?php

namespace App\Models;

use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;

class Article extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'title',
        'excerpt',
        'content',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::saving(static function (Article $article) {
            $article->slug = Str::slug($article->title);
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function isPublished(): bool
    {
        return (bool) $this->published_at;
    }

    public function scopePublished(Builder $query): void
    {
        $query->whereNotNull('published_at');
    }

    public function shouldBeSearchable(): bool
    {
        return $this->isPublished();
    }

    protected function formattedContent(): Attribute
    {
        return Attribute::get(fn () => Markdown::convert($this->content)->getContent());
    }

    protected function formattedPublishedDate(): Attribute
    {
        return Attribute::get(fn () => $this->published_at?->format('M d, Y'));
    }
}
