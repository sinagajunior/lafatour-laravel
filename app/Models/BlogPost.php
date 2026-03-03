<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class BlogPost extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'lafatour_blog_posts';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'featured_image',
        'category',
        'tags',
        'author_id',
        'is_published',
        'published_at',
        'meta_title',
        'meta_description',
        'view_count',
        'sort_order',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
        'tags' => 'array',
    ];

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->where('published_at', '<=', now());
    }

    public function scopeDraft($query)
    {
        return $query->where('is_published', false);
    }

    public function scopeNews($query)
    {
        return $query->where('category', 'news');
    }

    public function scopeTips($query)
    {
        return $query->where('category', 'tips');
    }

    public function scopeStories($query)
    {
        return $query->where('category', 'stories');
    }

    public function scopeGuidance($query)
    {
        return $query->where('category', 'guidance');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug) && !empty($model->title)) {
                $model->slug = \Str::slug($model->title);
            }

            // Auto-set published_at when post is published and published_at is empty
            if ($model->is_published && empty($model->published_at)) {
                $model->published_at = now();
            }
        });

        static::updating(function ($model) {
            // Auto-set published_at when post is published and published_at is empty
            if ($model->is_published && empty($model->published_at)) {
                $model->published_at = now();
            }
        });
    }

    public function getExcerptAttribute()
    {
        return $this->attributes['excerpt'] ?: \Str::limit(strip_tags($this->content), 150);
    }

    public function getFeaturedImageUrlAttribute()
    {
        if ($this->featured_image) {
            // If it's already a full URL, return it
            if (filter_var($this->featured_image, FILTER_VALIDATE_URL)) {
                return $this->featured_image;
            }

            // Check if file exists in storage
            if (Storage::disk('public')->exists($this->featured_image)) {
                return Storage::disk('public')->url($this->featured_image);
            }

            // Fallback to asset path
            return asset($this->featured_image);
        }

        // Return default placeholder
        return asset('assets/images/blog-placeholder.jpg');
    }
}
