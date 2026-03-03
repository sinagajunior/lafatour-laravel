<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Package extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'lafatour_packages';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'highlights',
        'type',
        'package_type_id',
        'haji_type',
        'price',
        'early_bird_price',
        'early_bird_until',
        'duration_days',
        'departure_date',
        'return_date',
        'quota',
        'seats_available',
        'hotel_mekkah',
        'hotel_madinah',
        'airline',
        'includes_hotel',
        'includes_flight',
        'includes_visa',
        'includes_meals',
        'includes_guide',
        'inclusions',
        'exclusions',
        'featured_image',
        'gallery_images',
        'meta_title',
        'meta_description',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'early_bird_price' => 'decimal:2',
        'early_bird_until' => 'date',
        'departure_date' => 'date',
        'return_date' => 'date',
        'includes_hotel' => 'boolean',
        'includes_flight' => 'boolean',
        'includes_visa' => 'boolean',
        'includes_meals' => 'boolean',
        'includes_guide' => 'boolean',
        'is_active' => 'boolean',
        'gallery_images' => 'array',
        'inclusions' => 'array',
        'exclusions' => 'array',
    ];

    public function itineraries()
    {
        return $this->hasMany(PackageItinerary::class)->orderBy('day_number');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function packageType()
    {
        return $this->belongsTo(PackageType::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeUmroh($query)
    {
        return $query->where('type', 'umroh');
    }

    public function scopeHaji($query)
    {
        return $query->where('type', 'haji');
    }

    public function scopeAvailable($query)
    {
        return $query->where('seats_available', '>', 0);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('departure_date', '>=', now());
    }

    public function getAvailableSeatsAttribute()
    {
        return max(0, $this->seats_available);
    }

    public function getCurrentPriceAttribute()
    {
        if ($this->early_bird_price && $this->early_bird_until && now()->lte($this->early_bird_until)) {
            return $this->early_bird_price;
        }
        return $this->price;
    }

    public function isEarlyBird()
    {
        return $this->early_bird_price &&
               $this->early_bird_until &&
               now()->lte($this->early_bird_until);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug) && !empty($model->name)) {
                $model->slug = \Str::slug($model->name);
            }
        });

        static::saving(function ($model) {
            if (empty($model->slug) && !empty($model->name)) {
                $model->slug = \Str::slug($model->name);
            }

            // Update seats available based on bookings
            $bookedCount = $model->bookings()->where('booking_status', '!=', 'cancelled')->count();
            $model->seats_available = max(0, $model->quota - $bookedCount);
        });
    }

    public function getDurationAttribute()
    {
        return $this->duration_days . ' Hari ' . ($this->duration_days - 1) . ' Malam';
    }

    public function getTypeLabelAttribute()
    {
        return ucfirst($this->type);
    }

    public function getFormattedPriceAttribute()
    {
        return 'IDR ' . number_format($this->price, 0, ',', '.');
    }

    public function getFormattedEarlyBirdPriceAttribute()
    {
        if (!$this->early_bird_price) return null;
        return 'IDR ' . number_format($this->early_bird_price, 0, ',', '.');
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
        return asset('assets/images/package-placeholder.jpg');
    }
}
