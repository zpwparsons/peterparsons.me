<?php

namespace App\Models;

use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'description',
    ];

    protected function formattedDescription(): Attribute
    {
        return Attribute::get(fn () => Markdown::convert($this->description)->getContent());
    }
}
