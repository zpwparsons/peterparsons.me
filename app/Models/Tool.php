<?php

namespace App\Models;

use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tool extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'description',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::saving(static function (Tool $tool) {
            $tool->slug = Str::slug($tool->category);
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected function formattedDescription(): Attribute
    {
        return Attribute::get(fn () => Markdown::convert($this->description)->getContent());
    }
}
