<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $featuredPackages = Package::active()
            ->withCount('testimonials')
            ->latest()
            ->take(6)
            ->get();

        $testimonials = Testimonial::approved()
            ->where('rating', '>=', 4)
            ->latest()
            ->take(6)
            ->get();

        return view('home', compact('featuredPackages', 'testimonials'));
    }
}
