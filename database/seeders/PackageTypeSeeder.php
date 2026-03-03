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
                'color' => 'primary',
                'sort_order' => 1,
            ],
            [
                'name' => 'Haji',
                'slug' => 'haji',
                'description' => 'Haji pilgrimage packages',
                'icon' => 'heroicon-o-star',
                'color' => 'success',
                'sort_order' => 2,
            ],
            [
                'name' => 'Umroh Plus',
                'slug' => 'umroh-plus',
                'description' => 'Umroh packages with additional destinations',
                'icon' => 'heroicon-o-globe-alt',
                'color' => 'info',
                'sort_order' => 3,
            ],
            [
                'name' => 'Haji Plus',
                'slug' => 'haji-plus',
                'description' => 'Haji packages with premium services',
                'icon' => 'heroicon-o-sparkles',
                'color' => 'warning',
                'sort_order' => 4,
            ],
            [
                'name' => 'Haji Furoda',
                'slug' => 'haji-furoda',
                'description' => 'Direct Haji without waiting (Visa Mujamalah)',
                'icon' => 'heroicon-o-academic-cap',
                'color' => 'danger',
                'sort_order' => 5,
            ],
            [
                'name' => 'Wisata Halal',
                'slug' => 'wisata-halal',
                'description' => 'Halal tourism packages',
                'icon' => 'heroicon-o-map',
                'color' => 'gray',
                'sort_order' => 6,
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
