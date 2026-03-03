@extends('layouts.app')

@section('content')
@php
    $page_title = $post->title;
    $page_meta_description = \Str::limit(strip_tags($post->content), 160);
@endphp

<article>
    <!-- Hero -->
    <header class="section bg-sky-700 text-white py-16">
        <div class="container">
            <div class="max-w-4xl mx-auto">
                <div class="flex items-center gap-3 text-sky-100 text-sm mb-4">
                    <a href="{{ route('blog.index') }}" class="hover:text-white transition">← Back to Blog</a>
                    <span>•</span>
                    <span class="bg-{{ $post->category == 'news' ? 'sky' : ($post->category == 'tips' ? 'amber' : ($post->category == 'guidance' ? 'green' : 'blue')) }}-500 bg-opacity-20 px-3 py-1 rounded-full">
                        {{ ucfirst($post->category) }}
                    </span>
                    <span>•</span>
                    <span>{{ $post->published_at ? $post->published_at->format('d M Y') : '' }}</span>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $post->title }}</h1>
                @if($post->excerpt)
                <p class="text-sky-100 text-xl">{{ $post->excerpt }}</p>
                @endif
            </div>
        </div>
    </header>

    <!-- Featured Image -->
    @if($post->featured_image_url)
    <div class="max-w-6xl mx-auto px-4 -mt-8 mb-8">
        <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}"
             class="w-full rounded-2xl shadow-xl">
    </div>
    @endif

    <!-- Content -->
    <section class="section">
        <div class="container">
            <div class="max-w-4xl mx-auto">
                <div class="prose prose-lg max-w-none">
                    {!! $post->content !!}
                </div>

                <!-- Tags -->
                @if($post->tags && is_array($post->tags))
                <div class="mt-8 pt-8 border-t">
                    <h3 class="text-lg font-semibold mb-4">Tags</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($post->tags as $tag)
                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">
                            {{ $tag }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Share -->
    <section class="section bg-gray-50">
        <div class="container">
            <div class="max-w-4xl mx-auto">
                <h3 class="text-xl font-bold mb-4">Share this article</h3>
                <div class="flex gap-3">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                       target="_blank" class="w-10 h-10 bg-blue-600 hover:bg-blue-700 text-white rounded-full flex items-center justify-center transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.77,7.46H14.5v-1.9c0-.9.6-1.1,1-1.1h3V.5h-4.33C10.24.5,9.5,3.44,9.5,5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4Z"/></svg>
                    </a>
                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(url()->current()) }}"
                       target="_blank" class="w-10 h-10 bg-sky-500 hover:bg-sky-600 text-white rounded-full flex items-center justify-center transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-3.35 1.49.9.9 0 01-.5 1.49.9 0 01.9.9.9 0 01-.5-.49 10.9 10.9 0 01-3.14 1.53v2.32A10.9 10.9 0 0023 12.32z"/></svg>
                    </a>
                    <a href="https://wa.me/?text={{ urlencode($post->title . ' - ' . url()->current()) }}"
                       target="_blank" class="w-10 h-10 bg-green-500 hover:bg-green-600 text-white rounded-full flex items-center justify-center transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.0669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Posts -->
    @if($relatedPosts && $relatedPosts->count() > 0)
    <section class="section">
        <div class="container">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-2xl font-bold mb-6">Related Articles</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedPosts as $related)
                    <div class="card bg-white rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-shadow">
                        @if($related->featured_image_url)
                        <a href="{{ route('blog.show', $related->slug) }}" class="block aspect-video overflow-hidden">
                            <img src="{{ $related->featured_image_url }}" alt="{{ $related->title }}"
                                 class="w-full h-full object-cover">
                        </a>
                        @endif
                        <div class="p-4">
                            <span class="text-xs text-sky-600 font-medium mb-1">{{ $related->published_at->format('d M Y') }}</span>
                            <h3 class="font-bold mb-2">
                                <a href="{{ route('blog.show', $related->slug) }}" class="hover:text-sky-600 transition">
                                    {{ $related->title }}
                                </a>
                            </h3>
                            <p class="text-sm text-gray-600 line-clamp-2">{{ $related->excerpt }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif
</article>
@endsection
