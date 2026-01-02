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
        'content' => 'string',
        'is_featured' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saving(function (Post $post): void {
            $source = $post->slug ?: $post->title ?: 'news';
            $post->slug = unique_slug(self::class, $source, $post->id, 'slug', 'news');
        });
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('thumbnail')->singleFile();
    }
}
