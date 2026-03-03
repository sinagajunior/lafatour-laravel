@extends('layouts.app')

@section('content')
@section('page_title', 'Paket Haji')

<!-- Hero Section with Ka'bah Background -->
<div class="relative py-20"
     style="background-image: url('{{ asset('assets/images/kaabah-hero.jpg') }}'); background-size: cover; background-position: center center; background-attachment: fixed;">
    <div class="absolute inset-0 bg-gradient-to-br from-amber-900/85 via-amber-800/80 to-sky-900/75"></div>
    <div class="container relative z-10 text-center text-white">
        <h1 class="text-4xl md:text-5xl font-bold mb-4 font-serif">Paket Haji</h1>
        <p class="text-amber-100 text-lg max-w-2xl mx-auto">
            Layanan lengkap untuk ibadah Haji Anda dengan bimbingan mutawwif berpengalaman
        </p>
    </div>
</div>

<section class="section">
    <div class="container">
        @if($packages->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($packages as $package)
                <div class="card bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300">
                    @if($package->featured_image_url)
                    <div class="relative h-56 overflow-hidden">
                        <img src="{{ $package->featured_image_url }}" alt="{{ $package->name }}"
                             class="w-full h-full object-cover">
                        @if($package->haji_type)
                        <div class="absolute top-4 right-4 bg-amber-500 text-white px-3 py-1 rounded-full text-sm font-semibold uppercase">
                            {{ $package->haji_type }}
                        </div>
                        @endif
                        @if($package->is_featured)
                        <div class="absolute top-4 left-4 bg-sky-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            Featured
                        </div>
                        @endif
                    </div>
                    @endif

                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-amber-600 bg-amber-50 px-3 py-1 rounded-full">
                                {{ $package->duration }}
                            </span>
                            @if($package->seats_available > 0)
                            <span class="text-sm text-green-600">
                                {{ $package->seats_available }} seats available
                            </span>
                            @else
                            <span class="text-sm text-red-600">
                                Fully Booked
                            </span>
                            @endif
                        </div>

                        <h3 class="text-xl font-bold mb-2 text-gray-900">{{ $package->name }}</h3>

                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                            {{ \Str::limit(strip_tags($package->description), 100) }}
                        </p>

                        <div class="mb-4">
                            @if($package->isEarlyBird())
                            <div class="flex items-center gap-2">
                                <span class="text-lg text-gray-400 line-through">Rp {{ number_format($package->price, 0, ',', '.') }}</span>
                                <span class="text-2xl font-bold text-amber-600">
                                    Rp {{ number_format($package->early_bird_price, 0, ',', '.') }}
                                </span>
                            </div>
                            @else
                            <span class="text-2xl font-bold text-amber-600">
                                Rp {{ number_format($package->price, 0, ',', '.') }}
                            </span>
                            @endif
                        </div>

                        <div class="flex items-center gap-2 text-sm text-gray-600 mb-4">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ $package->departure_date ? $package->departure_date->format('d M Y') : 'TBA' }}
                        </div>

                        <div class="flex gap-2">
                            <a href="{{ route('packages.show', $package->slug) }}"
                               class="flex-1 text-center bg-sky-500 hover:bg-sky-600 text-white px-4 py-2 rounded-lg font-medium transition">
                                View Details
                            </a>
                            <a href="{{ route('booking.create', ['package' => $package->id]) }}"
                               class="flex-1 text-center bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg font-medium transition">
                                Book Now
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $packages->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No Haji packages available</h3>
                <p class="text-gray-500">Please check back later</p>
            </div>
        @endif
    </div>
</section>
@endsection
