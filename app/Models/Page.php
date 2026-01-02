<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
        'content' => 'string', // If using a block builder, otherwise 'string' if rich editor
    ];

    protected static function booted(): void
    {
        static::saving(function (Page $page): void {
            $source = $page->slug ?: $page->title ?: $page->code ?: 'page';
            $page->slug = unique_slug(self::class, $source, $page->id, 'slug', 'page');
        });
    }
}
