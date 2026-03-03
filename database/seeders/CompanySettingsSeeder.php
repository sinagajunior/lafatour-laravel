<?php

namespace Database\Seeders;

use App\Models\CompanySetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default company settings if none exists
        if (!CompanySetting::exists()) {
            CompanySetting::create([
                'company_name' => 'Lavatour',
                'email' => 'info@lavatour.com',
                'phone' => '+1 234 567 8900',
                'address' => '123 Main Street, City, Country',
            ]);
        }
    }
}
