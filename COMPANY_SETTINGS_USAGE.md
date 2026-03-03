# Company Settings Usage Guide

## Overview
Company settings (name, email, address, phone, logo) can now be managed through the Filament admin panel and accessed throughout your application using helper functions.

## Admin Panel Access
1. Navigate to `/admin` in your browser
2. Click on "Company Settings" in the sidebar
3. Fill in the form fields:
   - Company Name
   - Email Address
   - Phone Number
   - Office Address
   - Company Logo (optional)
4. Click "Save" to update

## Usage in Blade Templates

```blade
<!-- Single setting value -->
<h1>{{ company_setting('company_name', 'Default Company Name') }}</h1>

<p>Email: {{ company_setting('email') }}</p>
<p>Phone: {{ company_setting('phone') }}</p>
<p>Address: {{ company_setting('address') }}</p>

<!-- Display logo if exists -->
@if(company_setting('logo'))
    <img src="{{ asset('storage/' . company_setting('logo')) }}" alt="{{ company_setting('company_name') }}">
@endif
```

## Usage in Controllers/PHP Code

```php
use function company_setting;
use function company_settings;

// Get a single setting
$companyName = company_setting('company_name');
$email = company_setting('email', 'default@example.com'); // with default

// Get all settings as object
$settings = company_settings();
echo $settings->company_name;
echo $settings->email;
```

## Database Structure

The `company_settings` table contains:
- `id` - Primary key
- `company_name` - Company name
- `email` - Email address
- `address` - Office address
- `phone` - Phone number
- `logo` - Company logo file path
- `created_at` - Timestamp
- `updated_at` - Timestamp

Note: There will always be only one record in this table, which is automatically created on first access.

## Files Created

1. **Migration**: `database/migrations/2026_03_02_011414_create_company_settings_table.php`
2. **Model**: `app/Models/CompanySetting.php`
3. **Filament Resource**: `app/Filament/Resources/CompanySettings/CompanySettingResource.php`
4. **Form Schema**: `app/Filament/Resources/CompanySettings/Schemas/CompanySettingsForm.php`
5. **Edit Page**: `app/Filament/Resources/CompanySettings/Pages/EditCompanySettings.php`
6. **Helper Functions**: `app/Helpers/CompanySettings.php`

The helper functions are automatically loaded through composer's autoload configuration.
