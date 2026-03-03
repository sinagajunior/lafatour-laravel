@extends('layouts.app')

@section('content')
@section('page_title', 'Berita & Artikel')

<div class="section bg-sky-700 text-white py-16">
    <div class="container text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Berita & Artikel</h1>
        <p class="text-sky-100 text-lg max-w-2xl mx-auto">
            Informasi terbaru seputar travel Umroh dan Haji
        </p>
    </div>
</div>

<section class="section">
    <div class="container">
        @if($posts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($posts as $post)
                <article class="card bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300">
                    @if($post->featured_image_url)
                    <a href="{{ route('blog.show', $post->slug) }}" class="block aspect-video overflow-hidden">
                        <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}"
                             class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                    </a>
                    @endif

                    <div class="p-6">
                        <div class="flex items-center gap-3 text-sm text-gray-500 mb-3">
                            <span class="bg-{{ $post->category == 'news' ? 'sky' : ($post->category == 'tips' ? 'amber' : ($post->category == 'guidance' ? 'green' : 'blue')) }}-100 text-{{ $post->category == 'news' ? 'sky' : ($post->category == 'tips' ? 'amber' : ($post->category == 'guidance' ? 'green' : 'blue')) }}-600 px-3 py-1 rounded-full text-xs font-medium">
                                {{ ucfirst($post->category) }}
                            </span>
                            <span>{{ $post->published_at ? $post->published_at->format('d M Y') : '' }}</span>
                        </div>

                        <h2 class="text-xl font-bold mb-3">
                            <a href="{{ route('blog.show', $post->slug) }}" class="hover:text-sky-600 transition">
                                {{ $post->title }}
                            </a>
                        </h2>

                        <p class="text-gray-600 mb-4 line-clamp-3">
                            {{ $post->excerpt }}
                        </p>

                        <div class="flex items-center justify-between">
                            <a href="{{ route('blog.show', $post->slug) }}"
                               class="text-sky-600 font-medium hover:text-sky-700 transition inline-flex items-center">
                                Baca Selengkapnya
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $posts->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v12a2 2 0 01-2 2z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m-6 4h6"></path>
                </svg>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No articles available</h3>
                <p class="text-gray-500">Please check back later</p>
            </div>
        @endif
    </div>
</section>
@endsection
