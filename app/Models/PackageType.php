<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PackageType extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
    ];

    public function packages(): HasMany
    {
        return $this->hasMany(Package::class);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
