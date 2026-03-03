@extends('layouts.app')

@section('content')
@php
    $page_title = $package->name;
    $page_meta_description = \Str::limit(strip_tags($package->description), 160);
@endphp

<div class="section bg-gradient-to-br from-sky-700 to-sky-900 text-white py-16">
    <div class="container">
        <div class="max-w-4xl mx-auto text-center">
            <div class="inline-flex items-center bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full mb-6">
                <svg class="w-5 h-5 mr-2 text-amber-300" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
                <span>{{ ucfirst($package->type) }} Package</span>
            </div>

            <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $package->name }}</h1>

            <div class="flex items-center justify-center gap-6 text-sky-100">
                <span class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    {{ $package->duration }}
                </span>
                <span class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    {{ $package->departure_date ? $package->departure_date->format('d F Y') : 'TBA' }}
                </span>
                <span class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    {{ $package->seats_available }} / {{ $package->quota }} seats
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Price Section -->
<section class="section bg-white">
    <div class="container">
        <div class="max-w-4xl mx-auto">
            <div class="card bg-gradient-to-r from-sky-50 to-amber-50 p-8 rounded-2xl">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-sm font-medium text-gray-600 block mb-1">Starting from</span>
                        @if($package->isEarlyBird())
                            <div class="flex items-center gap-3">
                                <span class="text-3xl text-gray-400 line-through">Rp {{ number_format($package->price, 0, ',', '.') }}</span>
                                <div>
                                    <span class="text-4xl font-bold text-sky-600">Rp {{ number_format($package->early_bird_price, 0, ',', '.') }}</span>
                                    <span class="text-sm text-red-600 font-semibold">Early Bird - until {{ $package->early_bird_until->format('d M Y') }}</span>
                                </div>
                            </div>
                        @else
                            <span class="text-4xl font-bold text-sky-600">Rp {{ number_format($package->price, 0, ',', '.') }}</span>
                        @endif
                    </div>
                    <a href="{{ route('booking.create', ['package' => $package->id]) }}"
                       class="bg-sky-500 hover:bg-sky-600 text-white px-8 py-4 rounded-xl font-semibold text-lg transition shadow-lg hover:shadow-xl">
                        Book Now
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Description -->
@section('content')
@if($package->description)
<section class="section">
    <div class="container">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl font-bold mb-6">About This Package</h2>
            <div class="prose prose-lg max-w-none text-gray-600">
                {{ $package->description }}
            </div>
        </div>
    </div>
</section>
@endif

<!-- Itinerary -->
@if($package->itineraries && $package->itineraries->count() > 0)
<section class="section bg-sky-50">
    <div class="container">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl font-bold mb-8">Itinerary</h2>
            <div class="space-y-6">
                @foreach($package->itineraries as $day)
                <div class="card bg-white p-6 rounded-xl shadow-sm">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-16 h-16 bg-sky-100 rounded-full flex items-center justify-center">
                            <span class="text-sky-600 font-bold text-xl">Day {{ $day->day_number }}</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $day->title }}</h3>
                            @if($day->location)
                            <p class="text-sky-600 font-medium mb-2">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                </svg>
                                {{ $day->location }}
                            </p>
                            @endif
                            @if($day->meals)
                            <p class="text-sm text-amber-600 mb-3">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                {{ $day->meals }}
                            </p>
                            @endif
                            @if($day->description)
                            <p class="text-gray-600">{{ $day->description }}</p>
                            @endif
                            @if($day->activities)
                            <ul class="mt-3 space-y-1 text-sm text-gray-600">
                                @foreach(json_decode($day->activities, true) as $activity)
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 mr-2 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $activity }}
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif

<!-- Inclusions & Exclusions -->
@if($package->inclusions || $package->exclusions)
<section class="section">
    <div class="container">
        <div class="max-w-4xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @if($package->inclusions)
                <div class="card bg-white p-6 rounded-xl shadow-sm">
                    <h3 class="text-xl font-bold mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Inclusions
                    </h3>
                    <ul class="space-y-2 text-gray-600">
                        @if(is_array($package->inclusions))
                            @foreach($package->inclusions as $inclusion)
                            <li class="flex items-start">
                                <svg class="w-4 h-4 mr-2 text-green-500 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                {{ $inclusion }}
                            </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                @endif

                @if($package->exclusions)
                <div class="card bg-white p-6 rounded-xl shadow-sm">
                    <h3 class="text-xl font-bold mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Exclusions
                    </h3>
                    <ul class="space-y-2 text-gray-600">
                        @if(is_array($package->exclusions))
                            @foreach($package->exclusions as $exclusion)
                            <li class="flex items-start">
                                <svg class="w-4 h-4 mr-2 text-red-500 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4a1 1 0 00-1.414-1.414l-2.293 2.293z" clip-rule="evenodd"/>
                                </svg>
                                {{ $exclusion }}
                            </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endif

<!-- Accommodation & Flight -->
@if($package->hotel_mekkah || $package->hotel_madinah || $package->airline)
<section class="section bg-gray-50">
    <div class="container">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl font-bold mb-8">Accommodation & Flight</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @if($package->hotel_mekkah)
                <div class="card bg-white p-6 rounded-xl shadow-sm text-center">
                    <svg class="w-12 h-12 mx-auto mb-4 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    <h3 class="font-semibold text-gray-900 mb-2">Hotel Mekkah</h3>
                    <p class="text-gray-600">{{ $package->hotel_mekkah }}</p>
                </div>
                @endif

                @if($package->hotel_madinah)
                <div class="card bg-white p-6 rounded-xl shadow-sm text-center">
                    <svg class="w-12 h-12 mx-auto mb-4 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    <h3 class="font-semibold text-gray-900 mb-2">Hotel Madinah</h3>
                    <p class="text-gray-600">{{ $package->hotel_madinah }}</p>
                </div>
                @endif

                @if($package->airline)
                <div class="card bg-white p-6 rounded-xl shadow-sm text-center">
                    <svg class="w-12 h-12 mx-auto mb-4 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 2 9 9zm0 0v-8"></path>
                    </svg>
                    <h3 class="font-semibold text-gray-900 mb-2">Airline</h3>
                    <p class="text-gray-600">{{ $package->airline }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endif

<!-- Gallery -->
@if($package->galleries && $package->galleries->count() > 0)
<section class="section">
    <div class="container">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl font-bold mb-8">Gallery</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($package->galleries as $image)
                <div class="aspect-square rounded-xl overflow-hidden cursor-pointer hover:opacity-90 transition"
                     onclick='openLightbox({{ json_encode($package->galleries->pluck('image_path')->toArray()) }}, {{ $loop->index }})'>
                    <img src="{{ $image->image_path }}" alt="{{ $image->title }}"
                         class="w-full h-full object-cover">
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif

<!-- Testimonials -->
@if($package->testimonials && $package->testimonials->count() > 0)
<section class="section bg-sky-700 text-white">
    <div class="container">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl font-bold mb-8">Testimonials</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($package->testimonials as $testimonial)
                <div class="card bg-white p-6 rounded-xl">
                    <div class="flex text-amber-400 mb-3">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $testimonial->rating)
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endif
                        @endfor
                    </div>
                    <p class="text-gray-600 mb-4 italic">"{{ $testimonial->review }}"</p>
                    <p class="font-semibold text-gray-900">{{ $testimonial->customer_name }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif

<!-- Related Packages -->
@if($relatedPackages && $relatedPackages->count() > 0)
<section class="section">
    <div class="container">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl font-bold mb-8">Related Packages</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedPackages as $related)
                <div class="card bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-shadow">
                    @if($related->featured_image_url)
                    <img src="{{ $related->featured_image_url }}" alt="{{ $related->name }}"
                         class="w-full h-48 object-cover">
                    @endif
                    <div class="p-4">
                        <h3 class="font-bold text-lg mb-2">{{ $related->name }}</h3>
                        <p class="text-sky-600 font-bold mb-3">Rp {{ number_format($related->price, 0, ',', '.') }}</p>
                        <a href="{{ route('packages.show', $related->slug) }}"
                           class="block text-center bg-sky-500 hover:bg-sky-600 text-white px-4 py-2 rounded-lg font-medium transition">
                            View Details
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif

@endsection
