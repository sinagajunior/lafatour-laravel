<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Testimonial extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'lafatour_testimonials';

    protected $fillable = [
        'customer_name',
        'package_id',
        'rating',
        'review',
        'travel_date',
        'photo',
        'video_url',
        'is_approved',
        'is_featured',
    ];

    protected $casts = [
        'rating' => 'integer',
        'travel_date' => 'date',
        'package_id' => 'integer',
        'is_approved' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeHighRated($query)
    {
        return $query->where('rating', '>=', 4);
    }
}
