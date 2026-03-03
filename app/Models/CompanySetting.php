<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanySetting extends Model
{
    protected $fillable = [
        'company_name',
        'email',
        'address',
        'phone',
        'logo',
        'motto',
    ];

    /**
     * Get company settings (creates default if not exists)
     */
    public static function getSettings()
    {
        $settings = self::first();
        if (!$settings) {
            $settings = self::create();
        }
        return $settings;
    }

    /**
     * Get a specific setting value
     */
    public static function getValue(string $key, $default = null)
    {
        $settings = self::getSettings();
        return $settings->$key ?? $default;
    }
}
