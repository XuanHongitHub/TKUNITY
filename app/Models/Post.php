<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;

class Post extends Model implements HasMedia
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory, InteractsWithMedia, HasTags;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'published_at',
        'status',
        'author_id',
        'category_id',
        'seo_title',
        'seo_description',
        'is_featured'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'content' => 'array',
        'is_featured' => 'boolean',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
