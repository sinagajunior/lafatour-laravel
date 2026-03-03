<?php

if (!function_exists('company_setting')) {
    /**
     * Get company setting value
     *
     * @param string $key The setting key (e.g., 'company_name', 'email', 'address', 'phone')
     * @param mixed $default Default value if setting not found
     * @return mixed
     */
    function company_setting(string $key, $default = null)
    {
        return \App\Models\CompanySetting::getValue($key, $default);
    }
}

if (!function_exists('company_settings')) {
    /**
     * Get all company settings
     *
     * @return \App\Models\CompanySetting
     */
    function company_settings()
    {
        return \App\Models\CompanySetting::getSettings();
    }
}
