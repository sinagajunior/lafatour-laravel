<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'lafatour_galleries';

    protected $fillable = [
        'title',
        'description',
        'image_path',
        'thumbnail_path',
        'category',
        'package_id',
        'alt_text',
        'video_url',
        'is_video',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_video' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected $appends = [
        'image_url',
        'thumbnail_url',
    ];

    public function getImageUrlAttribute()
    {
        if ($this->image_path) {
            // Check if it's already a full URL
            if (filter_var($this->image_path, FILTER_VALIDATE_URL)) {
                return $this->image_path;
            }
            // Check if file exists in storage (new uploads via Filament)
            if (Storage::disk('public')->exists($this->image_path)) {
                return Storage::disk('public')->url($this->image_path);
            }
            // Fall back to direct public path (legacy files)
            return asset($this->image_path);
        }
        return asset('assets/images/placeholder.jpg');
    }

    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail_path) {
            if (filter_var($this->thumbnail_path, FILTER_VALIDATE_URL)) {
                return $this->thumbnail_path;
            }
            // Check if file exists in storage
            if (Storage::disk('public')->exists($this->thumbnail_path)) {
                return Storage::disk('public')->url($this->thumbnail_path);
            }
            // Fall back to direct public path
            return asset($this->thumbnail_path);
        }
        return $this->image_url;
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeUmroh($query)
    {
        return $query->where('category', 'umroh');
    }

    public function scopeHaji($query)
    {
        return $query->where('category', 'haji');
    }

    public function scopeActivity($query)
    {
        return $query->where('category', 'activity');
    }

    public function scopeVideos($query)
    {
        return $query->where('is_video', true);
    }

    public function scopeImages($query)
    {
        return $query->where('is_video', false);
    }
}
