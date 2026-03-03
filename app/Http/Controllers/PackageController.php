<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\PackageType;

class PackageController extends Controller
{
    public function index(Request $request, $typeSlug)
    {
        $packageType = PackageType::where('slug', $typeSlug)->firstOrFail();

        $query = Package::active()->where('package_type_id', $packageType->id);

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

        return view('packages.index', compact('packages', 'packageType'));
    }

    public function show($slug)
    {
        $package = Package::where('slug', $slug)
            ->with(['packageType', 'itineraries', 'galleries', 'testimonials' => function($query) {
                $query->approved()->where('rating', '>=', 4);
            }])
            ->firstOrFail();

        $relatedPackages = Package::where('package_type_id', $package->package_type_id)
            ->where('id', '!=', $package->id)
            ->active()
            ->take(3)
            ->get();

        return view('packages.show', compact('package', 'relatedPackages'));
    }
}
