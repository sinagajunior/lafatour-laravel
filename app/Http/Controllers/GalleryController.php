<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $query = Gallery::active()->images(); // Only show images, not videos

        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        $galleries = $query->latest()->paginate(24);

        // Prepare lightbox data using image_url accessor
        $lightboxImages = $galleries->map(function($item) {
            return $item->image_url;
        })->toArray();
        $lightboxTitles = $galleries->pluck('title')->toArray();
        $lightboxDescriptions = $galleries->pluck('description')->toArray();

        $categories = [
            'umroh' => 'Umroh',
            'haji' => 'Haji',
            'activity' => 'Activity',
            'office' => 'Office',
            'team' => 'Team',
        ];

        $page_title = 'Galeri';
        $page_meta_description = 'Lihat koleksi foto dan video perjalanan ibadah Umroh dan Haji bersama LaFatour';

        return view('gallery', compact(
            'galleries',
            'categories',
            'page_title',
            'page_meta_description',
            'lightboxImages',
            'lightboxTitles',
            'lightboxDescriptions'
        ));
    }
}
