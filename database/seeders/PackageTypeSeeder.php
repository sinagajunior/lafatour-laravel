<?php

namespace Database\Seeders;

use App\Models\PackageType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'name' => 'Umroh',
                'slug' => 'umroh',
                'description' => 'Umroh pilgrimage packages',
                'icon' => 'heroicon-o-building-office',
            ],
            [
                'name' => 'Haji',
                'slug' => 'haji',
                'description' => 'Haji pilgrimage packages',
                'icon' => 'heroicon-o-star',
            ],
            [
                'name' => 'Umroh Plus',
                'slug' => 'umroh-plus',
                'description' => 'Umroh packages with additional destinations',
                'icon' => 'heroicono-globe-alt',
            ],
            [
                'name' => 'Haji Plus',
                'slug' => 'haji-plus',
                'description' => 'Haji packages with premium services',
                'icon' => 'heroicon-o-sparkles',
            ],
            [
                'name' => 'Haji Furoda',
                'slug' => 'haji-furoda',
                'description' => 'Direct Haji without waiting (Visa Mujamalah)',
                'icon' => 'heroicon-o-academic-cap',
            ],
            [
                'name' => 'Wisata Halal',
                'slug' => 'wisata-halal',
                'description' => 'Halal tourism packages',
                'icon' => 'heroicon-o-map',
            ],
        ];

        foreach ($types as $type) {
            PackageType::firstOrCreate(
                ['slug' => $type['slug']],
                $type
            );
        }

        $this->command->info('Package types seeded successfully!');
    }
}
