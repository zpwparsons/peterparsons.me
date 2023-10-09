<?php

namespace App\Models;

use App\Enums\ArticleStatus;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'excerpt',
        'content',
        'status',
        'published_at',
    ];

    protected $casts = [
        'status' => ArticleStatus::class,
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
        $query->where('status', ArticleStatus::Published);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
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
