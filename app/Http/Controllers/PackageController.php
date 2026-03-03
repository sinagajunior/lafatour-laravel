<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;

class PackageController extends Controller
{
    public function umroh(Request $request)
    {
        $query = Package::active()->umroh();

        if ($request->has('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }

        if ($request->has('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        if ($request->has('duration')) {
            $query->where('duration_days', $request->duration);
        }

        $packages = $query->orderBy('departure_date')->paginate(12);

        return view('packages.umroh', compact('packages'));
    }

    public function haji(Request $request)
    {
        $query = Package::active()->haji();

        if ($request->has('haji_type')) {
            $query->where('haji_type', $request->haji_type);
        }

        $packages = $query->orderBy('departure_date')->paginate(12);

        return view('packages.haji', compact('packages'));
    }

    public function show($slug)
    {
        $package = Package::where('slug', $slug)
            ->with(['itineraries', 'galleries', 'testimonials' => function($query) {
                $query->approved()->where('rating', '>=', 4);
            }])
            ->firstOrFail();

        $relatedPackages = Package::where('type', $package->type)
            ->where('id', '!=', $package->id)
            ->active()
            ->take(3)
            ->get();

        return view('packages.show', compact('package', 'relatedPackages'));
    }
}
