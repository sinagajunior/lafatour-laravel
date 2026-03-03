<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TeamMember extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'lafatour_team_members';

    protected $fillable = [
        'name',
        'slug',
        'position',
        'department',
        'photo',
        'bio',
        'email',
        'phone',
        'whatsapp',
        'social_media',
        'experience_years',
        'license_number',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'social_media' => 'array',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeManagement($query)
    {
        return $query->where('department', 'Management');
    }

    public function scopeSales($query)
    {
        return $query->where('department', 'Sales');
    }

    public function scopeGuides($query)
    {
        return $query->where('department', 'Guide');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug) && !empty($model->name)) {
                $model->slug = \Str::slug($model->name);
            }
        });
    }
}
