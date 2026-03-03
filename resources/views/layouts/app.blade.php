<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $page_meta_description ?? company_setting('company_name', 'LaFatour') . ' - Travel agency specialized in Umroh and Haji pilgrimage services' }}">
    <meta name="title" content="{{ $page_meta_title ?? $page_title ?? company_setting('company_name', 'LaFatour') }}">
    <link rel="canonical" href="{{ $canonical_url ?? url()->current() }}">

    <title>{{ $page_title ?? 'Home' }} | {{ company_setting('company_name', 'LaFatour') }}</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#ecfeff',
                            100: '#cffafe',
                            200: '#a5f3fc',
                            300: '#67e8f9',
                            400: '#22d3ee',
                            500: '#06b6d4',
                            600: '#0891b2',
                            700: '#0e7490',
                            800: '#155e75',
                            900: '#164e63',
                        },
                        sky: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        },
                        secondary: {
                            50: '#fffbeb',
                            100: '#fef3c7',
                            200: '#fde68a',
                            300: '#fcd34d',
                            400: '#fbbf24',
                            500: '#f59e0b',
                            600: '#d97706',
                            700: '#b45309',
                            800: '#92400e',
                            900: '#78350f',
                        },
                        accent: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Custom CSS -->
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @stack('styles')
</head>
<body class="font-sans antialiased text-gray-700 bg-sky-50"
      x-data="{ mobileMenuOpen: false, scrolled: false }"
      x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 10 })"
      :class="{ 'shadow-sm': scrolled }">

    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 z-50 bg-white shadow-sm transition-shadow duration-300">
        <!-- Top Bar -->
        <div class="hidden lg:block bg-gradient-to-r from-amber-600 via-sky-700 to-amber-600 text-white text-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-2">
                    <div class="flex items-center space-x-6">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            {{ company_setting('phone', '+62 81290001885') }}
                        </span>
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            {{ company_setting('email', 'info@lafatour.com') }}
                        </span>
                    </div>
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ route('filament.admin.auth.login') }}" class="hover:text-amber-200 transition flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c-.94 1.543-.826 3.31-.826 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31.826-2.37-.826a1.724 1.724 0 00-1.065-2.572c-.426-1.756-2.924-1.756-3.35 0a1.724 1.724 0 00-2.573 1.066c-1.543-.94-3.31-.826-2.37-.826a1.724 1.724 0 00-1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 002.573 1.066c1.543-.94 3.31-.826 2.37-.826a1.724 1.724 0 001.065 2.572c.426 1.756 2.924 1.756 3.35 0a1.724 1.724 0 002.572-1.066c1.543.94 3.31.826 2.37.826a1.724 1.724 0 001.066-2.572c1.756-.426 1.756-2.924 0-3.35a1.724 1.724 0 00-2.572-1.066c-.94-1.543-.826-3.31-.826-2.37a1.724 1.724 0 00-1.065-2.572c-.426-1.756-2.924-1.756-3.35 0a1.724 1.724 0 00-2.573 1.066c-1.543-.94-3.31-.826-2.37-.826a1.724 1.724 0 00-1.065 2.572c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31-.826 2.37-.826a1.724 1.724 0 001.065 2.572c.426 1.756 2.924 1.756 3.35 0a1.724 1.724 0 002.572-1.066c1.543.94 3.31.826 2.37.826a1.724 1.724 0 001.066-2.572c1.756-.426 1.756-2.924 0-3.35a1.7724 1.724 0 002.572 1.066c1.543-.94 3.31-.826 2.37-.826a1.724 1.724 0 001.065 2.572c.426 1.756 2.924 1.756 3.35 0a1.724 1.724 0 002.573-1.066c1.543.94 3.31.826 2.37.826a1.724 1.724 0 001.065-2.572C2.5 4.752 1.666 7.043 1.666 10.283c0 3.239-1.666 6.239-4.588 6.239z"/>
                                </svg>
                                Admin
                            </a>
                        @else
                            <a href="{{ route('filament.admin.auth.login') }}" class="hover:text-secondary-300 transition">Login</a>
                        @endauth
                        <a href="#" class="hover:text-secondary-300 transition">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.77,7.46H14.5v-1.9c0-.9.6-1.1,1-1.1h3V.5h-4.33C10.24.5,9.5,3.44,9.5,5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4Z"/></svg>
                        </a>
                        <a href="#" class="hover:text-secondary-300 transition">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12,2.16c3.2,0,3.58,0,4.85.07,3.25.15,4.77,1.69,4.92,4.92.06,1.27.07,1.65.07,4.85s0,3.58-.07,4.85c-.15,3.23-1.66,4.77-4.92,4.92-1.27.06-1.65.07-4.85.07s-3.58,0-4.85-.07c-3.26-.15-4.77-1.7-4.92-4.92-.06-1.27-.07-1.65-.07-4.85s0-3.58.07-4.85C2.38,3.92,3.9,2.38,7.15,2.23,8.42,2.18,8.8,2.16,12,2.16ZM12,0C8.74,0,8.33,0,7.05.07c-4.27.2-6.78,2.71-7,7C0,8.33,0,8.74,0,12s0,3.67.07,4.95c.2,4.27,2.71,6.78,7,7C8.33,24,8.74,24,12,24s3.67,0,4.95-.07c4.27-.2,6.78-2.71,7-7C24,15.67,24,15.26,24,12s0-3.67-.07-4.95c-.2-4.27-2.71-6.78-7-7C15.67,0,15.26,0,12,0Zm0,5.84A6.16,6.16,0,1,0,18.16,12,6.16,6.16,0,0,0,12,5.84ZM12,16a4,4,0,1,1,4-4A4,4,0,0,1,12,16ZM18.41,4.15a1.44,1.44,0,1,0,1.44,1.44A1.44,1.44,0,0,0,18.41,4.15Z"/></svg>
                        </a>
                        <a href="#" class="hover:text-secondary-300 transition">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.5,6.19a3.02,3.02,0,0,0-2.12-2.14C19.5,3.5,12,3.5,12,3.5s-7.5,0-9.38.55A3.02,3.02,0,0,0,.5,6.19,31.64,31.64,0,0,0,0,12a31.64,31.64,0,0,0,.5,5.81,3.02,3.02,0,0,0,2.12,2.14c1.88.55,9.38.55,9.38.55,9.38.55s7.5,0,9.38-.55a3.02,3.02,0,0,0,2.12-2.14A31.64,31.64,0,0,0,24,12,31.64,31.64,0,0,0,23.5,6.19ZM9.55,15.57V8.43L15.82,12Z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Navigation -->
        <nav class="bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <!-- Logo -->
                    <a href="{{ route('home') }}" class="flex items-center space-x-3">
                        @php
                            $logo = company_setting('logo');
                            $companyName = company_setting('company_name', 'LaFatour');
                            $motto = company_setting('motto');
                        @endphp
                        @if($logo)
                            <img src="{{ asset('storage/' . $logo) }}" alt="{{ $companyName }} Logo" class="h-14 w-auto rounded-lg shadow-md">
                        @else
                            <img src="{{ asset('assets/images/logo1.jpeg') }}" alt="{{ $companyName }} Logo" class="h-14 w-auto rounded-lg shadow-md">
                        @endif
                        <div>
                            <span class="text-2xl font-bold text-amber-600 font-serif">{{ $companyName }}</span>
                            @if($motto)
                                <span class="block text-xs text-gray-500 -mt-1">{{ $motto }}</span>
                            @else
                                <span class="block text-xs text-gray-500 -mt-1">Umroh & Haji Specialist</span>
                            @endif
                        </div>
                    </a>

                    <!-- Desktop Menu -->
                    <div class="hidden lg:flex items-center space-x-8">
                        <a href="{{ route('home') }}" class="text-gray-700 hover:text-amber-600 font-medium transition">Beranda</a>
                        @if(isset($packageTypes) && $packageTypes->count() > 0)
                        <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                            <button class="text-gray-700 hover:text-amber-600 font-medium transition flex items-center">
                                Paket
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="open" x-transition class="absolute top-full left-0 mt-2 w-56 bg-white rounded-lg shadow-lg py-2 z-50" style="display: none;">
                                @foreach($packageTypes as $type)
                                <a href="{{ route('packages.index', $type->slug) }}" class="block px-4 py-2 text-gray-700 hover:bg-amber-50 hover:text-amber-600 rounded-lg mx-2">
                                    {{ $type->name }}
                                </a>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        <a href="{{ route('about') }}" class="text-gray-700 hover:text-amber-600 font-medium transition">Tentang Kami</a>
                        <a href="{{ route('gallery') }}" class="text-gray-700 hover:text-amber-600 font-medium transition">Galeri</a>
                        <a href="{{ route('blog.index') }}" class="text-gray-700 hover:text-amber-600 font-medium transition">Berita</a>
                        <a href="{{ route('contact') }}" class="text-gray-700 hover:text-amber-600 font-medium transition">Kontak</a>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="hidden lg:flex items-center space-x-4">
                        <a href="{{ route('tracking') }}" class="text-gray-700 hover:text-amber-600 font-medium transition flex items-center">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Cek Pemesanan
                        </a>
                        <a href="{{ route('booking.create') }}" class="bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white px-6 py-2.5 rounded-lg font-medium transition shadow-md hover:shadow-lg">
                            Daftar Sekarang
                        </a>
                    </div>

                    <!-- Mobile Menu Button -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 rounded-lg text-gray-700 hover:bg-gray-100">
                        <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div x-show="mobileMenuOpen" x-transition class="lg:hidden bg-white border-t" style="display: none;">
                <div class="px-4 py-4 space-y-3">
                    <a href="{{ route('home') }}" class="block py-2 text-gray-700 hover:text-sky-600 font-medium">Beranda</a>
                    @if(isset($packageTypes) && $packageTypes->count() > 0)
                    <div class="py-2">
                        <span class="text-gray-700 font-medium">Paket</span>
                        <div class="mt-2 space-y-2 pl-4">
                            @foreach($packageTypes as $type)
                            <a href="{{ route('packages.index', $type->slug) }}" class="block py-1 text-gray-600 hover:text-sky-600">
                                {{ $type->name }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    <a href="{{ route('about') }}" class="block py-2 text-gray-700 hover:text-sky-600 font-medium">Tentang Kami</a>
                    <a href="{{ route('gallery') }}" class="block py-2 text-gray-700 hover:text-sky-600 font-medium">Galeri</a>
                    <a href="{{ route('blog.index') }}" class="block py-2 text-gray-700 hover:text-sky-600 font-medium">Berita</a>
                    <a href="{{ route('contact') }}" class="block py-2 text-gray-700 hover:text-sky-600 font-medium">Kontak</a>
                    <a href="{{ route('tracking') }}" class="block py-2 text-gray-700 hover:text-sky-600 font-medium">Cek Pemesanan</a>
                    <a href="{{ route('booking.create') }}" class="block bg-sky-500 text-white px-4 py-2.5 rounded-lg font-medium text-center">Daftar Sekarang</a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="pt-32 lg:pt-40">
        @yield('content')
    </main>

    <!-- WhatsApp Float Button -->
    @php
        $phoneForWhatsApp = str_replace(['+', ' ', '(', ')', '-'], '', company_setting('phone', '+62 81290001885'));
    @endphp
    <a href="https://wa.me/{{ $phoneForWhatsApp }}" target="_blank" class="fixed bottom-6 right-6 z-40 bg-green-500 hover:bg-green-600 text-white p-4 rounded-full shadow-lg transition transform hover:scale-110">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.0669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
    </a>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- About -->
                <div>
                    @php
                        $footerLogo = company_setting('logo');
                        $footerCompanyName = company_setting('company_name', 'LaFatour');
                    @endphp
                    <div class="flex items-center space-x-2 mb-4">
                        @if($footerLogo)
                            <img src="{{ asset('storage/' . $footerLogo) }}" alt="{{ $footerCompanyName }} Logo" class="h-10 w-auto rounded-lg">
                        @else
                            <img src="{{ asset('assets/images/logo1.jpeg') }}" alt="{{ $footerCompanyName }} Logo" class="h-10 w-auto rounded-lg">
                        @endif
                        <span class="text-xl font-bold text-white font-serif">{{ $footerCompanyName }}</span>
                    </div>
                    <p class="text-gray-400 text-sm mb-4">
                        Travel agency terpercaya yang bergerak di bidang perjalanan ibadah Umroh dan Haji sejak 2015. Melayani dengan sepenuh hati.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-sky-400 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.77,7.46H14.5v-1.9c0-.9.6-1.1,1-1.1h3V.5h-4.33C10.24.5,9.5,3.44,9.5,5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4Z"/></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-sky-400 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12,2.16c3.2,0,3.58,0,4.85.07,3.25.15,4.77,1.69,4.92,4.92.06,1.27.07,1.65.07,4.85s0,3.58-.07,4.85c-.15,3.23-1.66,4.77-4.92,4.92-1.27.06-1.65.07-4.85.07s-3.58,0-4.85-.07c-3.26-.15-4.77-1.7-4.92-4.92-.06-1.27-.07-1.65-.07-4.85s0-3.58.07-4.85C2.38,3.92,3.9,2.38,7.15,2.23,8.42,2.18,8.8,2.16,12,2.16ZM12,0C8.74,0,8.33,0,7.05.07c-4.27.2-6.78,2.71-7,7C0,8.33,0,8.74,0,12s0,3.67.07,4.95c.2,4.27,2.71,6.78,7,7C8.33,24,8.74,24,12,24s3.67,0,4.95-.07c4.27-.2,6.78-2.71,7-7C24,15.67,24,15.26,24,12s0-3.67-.07-4.95c-.2-4.27-2.71-6.78-7-7C15.67,0,15.26,0,12,0Zm0,5.84A6.16,6.16,0,1,0,18.16,12,6.16,6.16,0,0,0,12,5.84ZM12,16a4,4,0,1,1,4-4A4,4,0,0,1,12,16ZM18.41,4.15a1.44,1.44,0,1,0,1.44,1.44A1.44,1.44,0,0,0,18.41,4.15Z"/></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-sky-400 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.5,6.19a3.02,3.02,0,0,0-2.12-2.14C19.5,3.5,12,3.5,12,3.5s-7.5,0-9.38.55A3.02,3.02,0,0,0,.5,6.19,31.64,31.64,0,0,0,0,12a31.64,31.64,0,0,0,.5,5.81,3.02,3.02,0,0,0,2.12,2.14c1.88.55,9.38.55,9.38.55,9.38.55s7.5,0,9.38-.55a3.02,3.02,0,0,0,2.12-2.14A31.64,31.64,0,0,0,24,12,31.64,31.64,0,0,0,23.5,6.19ZM9.55,15.57V8.43L15.82,12Z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-white font-semibold mb-4">Tautan Cepat</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-sky-400 transition">Beranda</a></li>
                        @if(isset($packageTypes) && $packageTypes->count() > 0)
                            @foreach($packageTypes->take(2) as $type)
                            <li><a href="{{ route('packages.index', $type->slug) }}" class="hover:text-sky-400 transition">{{ $type->name }}</a></li>
                            @endforeach
                        @endif
                        <li><a href="{{ route('about') }}" class="hover:text-sky-400 transition">Tentang Kami</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-sky-400 transition">Kontak</a></li>
                    </ul>
                </div>

                <!-- Services -->
                <div>
                    <h3 class="text-white font-semibold mb-4">Layanan</h3>
                    <ul class="space-y-2 text-sm">
                        @if(isset($packageTypes) && $packageTypes->count() > 0)
                            @foreach($packageTypes->take(4) as $type)
                            <li><a href="{{ route('packages.index', $type->slug) }}" class="hover:text-sky-400 transition">{{ $type->name }}</a></li>
                            @endforeach
                        @endif
                        <li><a href="{{ route('tracking') }}" class="hover:text-sky-400 transition">Cek Pemesanan</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="text-white font-semibold mb-4">Hubungi Kami</h3>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-2 text-sky-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>{{ company_setting('address', 'Jl. H. Rasuna Said Kav 10, Jakarta Selatan, 12950') }}</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-sky-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span>{{ company_setting('phone', '+62 81290001885') }}</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-sky-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span>{{ company_setting('email', 'hello@lafatour.com') }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-sm text-center text-gray-400">
                <p>&copy; {{ date('Y') }} LaFatour. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Fullscreen Lightbox Gallery -->
    <div id="lightbox" class="fixed inset-0 bg-black z-[9999] hidden flex-col" style="backdrop-filter: blur(10px);">
        <!-- Close Button -->
        <button onclick="closeLightbox()" class="absolute top-6 right-6 text-white hover:text-amber-400 z-[10000] transition-all duration-300 hover:rotate-90">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <!-- Navigation Arrows -->
        <button onclick="prevImage(); event.stopPropagation();" class="absolute left-4 md:left-8 top-1/2 -translate-y-1/2 text-white hover:text-amber-400 z-[10000] transition-all duration-300 hover:scale-110">
            <svg class="w-12 h-12 md:w-16 md:h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        <button onclick="nextImage(); event.stopPropagation();" class="absolute right-4 md:right-8 top-1/2 -translate-y-1/2 text-white hover:text-amber-400 z-[10000] transition-all duration-300 hover:scale-110">
            <svg class="w-12 h-12 md:w-16 md:h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>

        <!-- Image Container -->
        <div class="flex-1 flex items-center justify-center p-4 md:p-8">
            <div class="relative max-w-7xl w-full">
                <img id="lightbox-img" src="" alt="Gallery Image" class="w-full h-auto max-h-[85vh] object-contain rounded-lg shadow-2xl">

                <!-- Caption -->
                <div id="lightbox-caption" class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/90 via-black/60 to-transparent p-6 rounded-b-lg">
                    <h3 id="lightbox-title" class="text-white text-xl md:text-2xl font-bold mb-2"></h3>
                    <p id="lightbox-description" class="text-gray-300 text-sm md:text-base"></p>
                    <div class="flex items-center justify-between mt-4">
                        <span id="lightbox-counter" class="text-amber-400 text-sm font-medium"></span>
                        <div class="flex gap-2">
                            <button onclick="downloadImage(); event.stopPropagation();" class="text-white hover:text-amber-400 transition-colors" title="Download">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                            </button>
                            <button onclick="toggleFullscreen(); event.stopPropagation();" class="text-white hover:text-amber-400 transition-colors" title="Fullscreen">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fullscreen Lightbox functionality
        let currentImages = [];
        let currentIndex = 0;
        let currentTitles = [];
        let currentDescriptions = [];

        function openLightbox(images, index, titles = [], descriptions = []) {
            currentImages = images;
            currentIndex = index;
            currentTitles = titles;
            currentDescriptions = descriptions;

            const lightbox = document.getElementById('lightbox');
            const img = document.getElementById('lightbox-img');

            img.src = images[currentIndex];
            updateCaption();

            lightbox.classList.remove('hidden');
            lightbox.classList.add('flex');
            document.body.style.overflow = 'hidden';

            // Add animation
            img.style.opacity = '0';
            setTimeout(() => {
                img.style.transition = 'opacity 0.3s ease';
                img.style.opacity = '1';
            }, 10);
        }

        function closeLightbox() {
            const lightbox = document.getElementById('lightbox');
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
            document.body.style.overflow = '';
        }

        function nextImage() {
            currentIndex = (currentIndex + 1) % currentImages.length;
            const img = document.getElementById('lightbox-img');
            img.style.opacity = '0';
            setTimeout(() => {
                img.src = currentImages[currentIndex];
                updateCaption();
                img.style.opacity = '1';
            }, 150);
        }

        function prevImage() {
            currentIndex = (currentIndex - 1 + currentImages.length) % currentImages.length;
            const img = document.getElementById('lightbox-img');
            img.style.opacity = '0';
            setTimeout(() => {
                img.src = currentImages[currentIndex];
                updateCaption();
                img.style.opacity = '1';
            }, 150);
        }

        function updateCaption() {
            const title = document.getElementById('lightbox-title');
            const description = document.getElementById('lightbox-description');
            const counter = document.getElementById('lightbox-counter');

            title.textContent = currentTitles[currentIndex] || '';
            description.textContent = currentDescriptions[currentIndex] || '';
            counter.textContent = `${currentIndex + 1} / ${currentImages.length}`;
        }

        function downloadImage() {
            const link = document.createElement('a');
            link.href = currentImages[currentIndex];
            link.download = 'lafatour-gallery.jpg';
            link.click();
        }

        function toggleFullscreen() {
            const lightbox = document.getElementById('lightbox');
            if (!document.fullscreenElement) {
                lightbox.requestFullscreen().catch(err => {
                    console.log('Fullscreen error:', err);
                });
            } else {
                document.exitFullscreen();
            }
        }

        // Click outside to close
        document.getElementById('lightbox').addEventListener('click', function(e) {
            if (e.target === this) {
                closeLightbox();
            }
        });

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            const lightbox = document.getElementById('lightbox');
            if (!lightbox.classList.contains('hidden')) {
                if (e.key === 'Escape') closeLightbox();
                if (e.key === 'ArrowRight') nextImage();
                if (e.key === 'ArrowLeft') prevImage();
                if (e.key === 'f' || e.key === 'F') toggleFullscreen();
            }
        });

        // Touch swipe support
        let touchStartX = 0;
        let touchEndX = 0;

        document.getElementById('lightbox').addEventListener('touchstart', function(e) {
            touchStartX = e.changedTouches[0].screenX;
        });

        document.getElementById('lightbox').addEventListener('touchend', function(e) {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        });

        function handleSwipe() {
            const swipeThreshold = 50;
            if (touchEndX < touchStartX - swipeThreshold) {
                nextImage(); // Swipe left
            }
            if (touchEndX > touchStartX + swipeThreshold) {
                prevImage(); // Swipe right
            }
        }
    </script>

    @stack('scripts')
</body>
</html>
