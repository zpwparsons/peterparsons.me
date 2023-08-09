<?php

namespace App\Models;

use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'excerpt',
        'content',
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

    protected function formattedContent(): Attribute
    {
        return Attribute::get(fn () => Markdown::convert($this->content)->getContent());
    }

    protected function formattedCreatedAt(): Attribute
    {
        return Attribute::get(fn () => $this->created_at->format('M d, Y'));
    }
}
