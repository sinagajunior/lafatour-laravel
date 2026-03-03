<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gallery;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing galleries first
        Gallery::truncate();

        $galleries = [
            [
                'title' => 'Kaabah - Masjidil Haram',
                'description' => 'Pandangan indah Kaabah di Masjidil Haram, Makkah',
                'image_path' => 'uploads/gallery/kabah2.jpg',
                'category' => 'umroh',
                'alt_text' => 'Kaabah di Masjidil Haram Makkah',
                'is_video' => false,
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Madina - Masjid Nabawi',
                'description' => 'Gerbang utama Masjid Nabawi di Madinah',
                'image_path' => 'uploads/gallery/madina_gate.jpg',
                'category' => 'umroh',
                'alt_text' => 'Gerbang Masjid Nabawi Madinah',
                'is_video' => false,
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Madinah City View',
                'description' => 'Pemandangan kota Madinah yang indah',
                'image_path' => 'uploads/gallery/madinatown.jpg',
                'category' => 'umroh',
                'alt_text' => 'Pemandangan kota Madinah',
                'is_video' => false,
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Umbrella Courtyard Madinah',
                'description' => 'Halaman dengan payung-payung di Masjid Nabawi',
                'image_path' => 'uploads/gallery/madinaumbrella.jpg',
                'category' => 'umroh',
                'alt_text' => 'Payung-payung di Masjid Nabawi',
                'is_video' => false,
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Kaabah at Night',
                'description' => 'Suasana Kaabah yang damai di malam hari',
                'image_path' => 'uploads/gallery/kabah3.jpg',
                'category' => 'haji',
                'alt_text' => 'Kaabah di malam hari',
                'is_video' => false,
                'sort_order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($galleries as $gallery) {
            Gallery::create($gallery);
        }
    }
}
