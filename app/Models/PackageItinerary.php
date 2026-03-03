<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PackageItinerary extends Model
{
    use HasFactory;

    protected $table = 'lafatour_package_itineraries';

    protected $fillable = [
        'package_id',
        'day_number',
        'title',
        'description',
        'activities',
        'meals',
        'accommodation',
        'location',
        'image',
    ];

    protected $casts = [
        'activities' => 'array',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
