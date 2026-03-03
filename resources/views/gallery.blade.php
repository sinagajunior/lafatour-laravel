@extends('layouts.app')

@section('content')
@section('page_title', 'Galeri')

<!-- Hero Section with Ka'bah Background -->
<div class="relative py-20 md:py-28"
     style="background-image: url('{{ asset('assets/images/kaabah-hero.jpg') }}'); background-size: cover; background-position: center center; background-attachment: fixed;">
    <div class="absolute inset-0 bg-gradient-to-br from-sky-900/85 via-sky-800/80 to-amber-900/75"></div>
    <div class="container relative z-10 text-center text-white">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 font-serif">Galeri</h1>
        <p class="text-sky-100 text-lg md:text-xl max-w-2xl mx-auto">
            Dokumentasi perjalanan ibadah jamaah kami
        </p>
    </div>
</div>

<!-- Category Filter -->
<section class="section bg-sky-50">
    <div class="container">
        <div class="flex flex-wrap justify-center gap-3 mb-8">
            <a href="{{ route('gallery') }}"
               class="px-6 py-2.5 rounded-full font-medium transition shadow-sm {{ !request('category') ? 'bg-sky-500 text-white shadow-md' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
                Semua
            </a>
            @foreach($categories as $key => $label)
            <a href="{{ route('gallery', ['category' => $key]) }}"
               class="px-6 py-2.5 rounded-full font-medium transition shadow-sm {{ request('category') == $key ? 'bg-sky-500 text-white shadow-md' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
                {{ $label }}
            </a>
            @endforeach
        </div>

        @if($galleries->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($galleries as $index => $item)
                <div class="card bg-white rounded-xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 gallery-item group">
                    <div class="relative aspect-square cursor-pointer"
                         onclick="openLightbox(@js($lightboxImages), {{ $index }}, @js($lightboxTitles), @js($lightboxDescriptions))">
                        @if($item->thumbnail_url)
                        <img src="{{ $item->thumbnail_url }}"
                             alt="{{ $item->alt_text ?: $item->title }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @elseif($item->image_url)
                        <img src="{{ $item->image_url }}"
                             alt="{{ $item->alt_text ?: $item->title }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        @endif

                        <!-- Hover Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <svg class="w-16 h-16 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform scale-50 group-hover:scale-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                                </svg>
                            </div>
                        </div>

                        <!-- Category Badge -->
                        @if($item->category)
                        <div class="absolute top-3 left-3">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                {{ $item->category == 'umroh' ? 'bg-sky-500' :
                                   ($item->category == 'haji' ? 'bg-green-500' :
                                   ($item->category == 'activity' ? 'bg-amber-500' : 'bg-gray-500')) }} text-white shadow-md">
                                {{ ucfirst($item->category) }}
                            </span>
                        </div>
                        @endif

                        <!-- Title at bottom -->
                        @if($item->title)
                        <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/80 to-transparent">
                            <p class="text-white text-sm font-medium truncate">{{ $item->title }}</p>
                            @if($item->description)
                            <p class="text-gray-300 text-xs truncate">{{ $item->description }}</p>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                {{ $galleries->appends(request()->query())->links('pagination::tailwind') }}
            </div>

            <!-- Gallery Info -->
            <div class="mt-8 text-center">
                <p class="text-gray-600 text-sm">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Klik gambar untuk melihat ukuran penuh. Gunakan panah keyboard atau swipe untuk navigasi.
                </p>
            </div>
        @else
            <div class="text-center py-16">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <h3 class="text-2xl font-semibold text-gray-700 mb-3">Belum ada gambar</h3>
                <p class="text-gray-500 mb-6">Gambar akan segera ditambahkan</p>
                <a href="{{ route('home') }}" class="inline-flex items-center text-sky-600 hover:text-sky-700 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>
        @endif
    </div>
</section>
@endsection
