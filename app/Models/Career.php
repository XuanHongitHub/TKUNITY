<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'department',
        'location',
        'employment_type',
        'summary',
        'description',
        'apply_url',
        'is_active',
        'posted_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'posted_at' => 'datetime',
        'summary' => 'string',
        'description' => 'string',
    ];

    protected static function booted(): void
    {
        static::saving(function (Career $career): void {
            $source = $career->slug ?: $career->title ?: 'career';
            $career->slug = unique_slug(self::class, $source, $career->id, 'slug', 'career');
        });
    }
}
