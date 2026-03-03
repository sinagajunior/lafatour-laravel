@extends('layouts.app')

@section('content')
<div class="hero-section relative min-h-screen flex items-center"
     style="background-image: url('{{ asset('assets/images/kaabah-hero.jpg') }}'); background-size: cover; background-position: center center; background-attachment: fixed;">
    <div class="absolute inset-0 bg-gradient-to-br from-sky-900/85 via-sky-800/80 to-amber-900/75"></div>
    <div class="absolute inset-0 bg-pattern opacity-10"></div>
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-sky-50"></div>
    </div>

    <div class="container relative z-10 pt-32 pb-20">
        <div class="max-w-4xl mx-auto text-center text-white">
            <div class="inline-flex items-center bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full mb-6">
                <svg class="w-5 h-5 mr-2 text-amber-300" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
                <span>Dipercaya lebih dari 500 Jamaah</span>
            </div>

            <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-6 font-serif">
                Traveling ke <span class="text-amber-300">Tanah Suci</span>
            </h1>

            <p class="text-xl md:text-2xl text-sky-100 mb-10 max-w-3xl mx-auto">
               Rasakan pengalaman ibadah Umrah dan Haji yang penuh makna spiritual dengan layanan profesional dan terpercaya kami.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('packages.umroh') }}" class="btn btn-secondary text-lg px-8 py-4 shadow-xl">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Temukan paket Umroh
                </a>
                <a href="{{ route('packages.haji') }}" class="btn btn-outline-white text-lg px-8 py-4">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Temukan paket Haji
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Package Categories -->
<section class="section">
    <div class="container">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Pilih destinasi anda</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Pilihlah dari paket-paket yang telah kami rancang dengan cermat untuk perjalanan spiritual Anda.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-6xl mx-auto">
            <a href="{{ route('packages.umroh') }}" class="group card overflow-hidden hover-2xl transition-all duration-300 cursor-pointer">
                <div class="relative h-64 overflow-hidden">
                    <img src="{{ asset('assets/images/kabahside.avif') }}" alt="Umroh Pilgrimage" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-sky-900/80 via-sky-700/50 to-transparent"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="text-center text-white">
                            <svg class="w-16 h-16 mx-auto mb-2 opacity-80" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="p-8 text-center">
                    <h3 class="text-2xl font-bold mb-2">Umroh Packages</h3>
                    <p class="text-gray-600 mb-4">Flexible pilgrimage packages throughout the year</p>
                    <span class="text-sky-600 font-semibold group-hover:translate-x-2 inline-flex items-center transition-transform">
                        View Packages
                        <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </span>
                </div>
            </a>

            <a href="{{ route('packages.haji') }}" class="group card overflow-hidden hover-2xl transition-all duration-300 cursor-pointer">
                <div class="relative h-64 overflow-hidden">
                    <img src="{{ asset('assets/images/madina_gate.jpg') }}" alt="Haji Pilgrimage" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-amber-900/80 via-amber-700/50 to-transparent"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="text-center text-white">
                            <svg class="w-16 h-16 mx-auto mb-2 opacity-80" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="p-8 text-center">
                    <h3 class="text-2xl font-bold mb-2">Haji Packages</h3>
                    <p class="text-gray-600 mb-4">Complete Haji preparation and guidance services</p>
                    <span class="text-sky-600 font-semibold group-hover:translate-x-2 inline-flex items-center transition-transform">
                        View Packages
                        <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </span>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="section">
    <div class="container">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Why Choose LaFatour?</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">We are committed to providing the best pilgrimage experience</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 max-w-6xl mx-auto">
            <div class="text-center">
                <div class="w-16 h-16 bg-sky-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Trusted & Licensed</h3>
                <p class="text-gray-600 text-sm">Officially licensed travel agency with years of experience</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Expert Guides</h3>
                <p class="text-gray-600 text-sm">Professional and knowledgeable mutawwif throughout journey</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Premium Hotels</h3>
                <p class="text-gray-600 text-sm">Close proximity to Haram with comfortable accommodations</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Best Price</h3>
                <p class="text-gray-600 text-sm">Competitive pricing with no hidden fees or charges</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="section bg-sky-700 text-white">
    <div class="container">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">What Our Pilgrims Say</h2>
            <p class="text-sky-100 max-w-2xl mx-auto">Real experiences from our satisfied customers</p>
        </div>

        @include('components.testimonials-carousel', ['limit' => 6, 'minRating' => 4])
    </div>
</section>

<!-- CTA Section -->
<section class="section">
    <div class="container">
        <div class="card bg-gradient-to-r from-sky-600 to-sky-800 text-white p-12 text-center rounded-2xl max-w-5xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Ready for Your Spiritual Journey?</h2>
            <p class="text-sky-100 mb-8 max-w-2xl mx-auto">
                Book your Umroh or Haji package today and let us help you fulfill your dream of visiting the Holy Land
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('booking.create') }}" class="btn btn-secondary text-lg px-8 py-4">
                    Book Now
                </a>
                <a href="https://wa.me/6281290001885" target="_blank" class="btn btn-outline-white text-lg px-8 py-4">
                    Consult via WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
