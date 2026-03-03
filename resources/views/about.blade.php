@extends('layouts.app')

@section('content')
@section('page_title', 'Tentang Kami')

<div class="section bg-sky-700 text-white py-16">
    <div class="container text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Tentang LaFatour</h1>
        <p class="text-sky-100 text-lg max-w-2xl mx-auto">
            Melayani jamaah Umroh dan Haji dengan sepenuh hati sejak 2015
        </p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="max-w-4xl mx-auto">
            <div class="prose prose-lg max-w-none mb-12">
                <h2 class="text-3xl font-bold mb-6">Our Story</h2>
                <p class="text-gray-600 mb-4">
                    LaFatour didirikan dengan visi untuk memberikan pelayanan terbaik bagi jamaah Indonesia yang ingin menunaikan ibadah Umroh dan Haji. Sejak 2015, kami telah melayani ribuan jamaah dengan komitmen terhadap kualitas, kenyamanan, dan kekhusyukan ibadah.
                </p>
                <p class="text-gray-600 mb-4">
                    Kami memahami bahwa perjalanan ibadah adalah momen yang sakral dan sangat dinantikan. Oleh karena itu, kami berusaha memberikan pelayanan yang profesional, transparan, dan penuh perhatian terhadap setiap kebutuhan jamaah.
                </p>
            </div>

            <div class="mb-12">
                <h2 class="text-3xl font-bold mb-8">Visi & Misi</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="card bg-sky-50 p-6 rounded-xl">
                        <h3 class="text-xl font-bold text-sky-700 mb-4">Visi</h3>
                        <p class="text-gray-600">
                            Menjadi biro perjalanan ibadah Umroh dan Haji terpercaya yang memberikan pelayanan terbaik dengan mengutamakan kepuasan dan kenyamanan jamaah.
                        </p>
                    </div>
                    <div class="card bg-amber-50 p-6 rounded-xl">
                        <h3 class="text-xl font-bold text-amber-700 mb-4">Misi</h3>
                        <ul class="text-gray-600 space-y-2">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 mr-2 text-amber-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                Memberikan pelayanan yang profesional dan terpercaya
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 mr-2 text-amber-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                Memfasilitasi ibadah yang nyaman dan sesuai syariat
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 mr-2 text-amber-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                Menjaga kepercayaan dan kepuasan jamaah
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="mb-12">
                <h2 class="text-3xl font-bold mb-8">Our Values</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="card bg-white p-6 rounded-xl shadow-sm text-center">
                        <div class="w-16 h-16 bg-sky-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Ikhlas</h3>
                        <p class="text-gray-600">Melayani dengan niat tulus karena Allah SWT</p>
                    </div>

                    <div class="card bg-white p-6 rounded-xl shadow-sm text-center">
                        <div class="w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Amanah</h3>
                        <p class="text-gray-600">Dapat dipercaya dalam segala hal</p>
                    </div>

                    <div class="card bg-white p-6 rounded-xl shadow-sm text-center">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Profesional</h3>
                        <p class="text-gray-600">Pelayanan terbaik dengan standar tinggi</p>
                    </div>
                </div>
            </div>

            @if($teamMembers && $teamMembers->count() > 0)
            <div>
                <h2 class="text-3xl font-bold mb-8">Our Team</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($teamMembers as $member)
                    <div class="card bg-white p-6 rounded-xl shadow-sm text-center">
                        @if($member->photo)
                        <img src="{{ $member->photo }}" alt="{{ $member->name }}"
                             class="w-24 h-24 rounded-full mx-auto mb-4 object-cover">
                        @else
                        <div class="w-24 h-24 bg-sky-100 rounded-full mx-auto mb-4 flex items-center justify-center">
                            <span class="text-2xl font-bold text-sky-600">{{ substr($member->name, 0, 1) }}</span>
                        </div>
                        @endif
                        <h3 class="text-lg font-bold text-gray-900">{{ $member->name }}</h3>
                        <p class="text-sky-600 font-medium mb-2">{{ $member->position }}</p>
                        @if($member->department)
                        <p class="text-sm text-gray-500 mb-3">{{ $member->department }}</p>
                        @endif
                        @if($member->email)
                        <a href="mailto:{{ $member->email }}" class="inline-flex items-center text-sm text-gray-600 hover:text-sky-600">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Email
                        </a>
                        @endif
                        @if($member->whatsapp)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $member->whatsapp) }}" class="inline-flex items-center text-sm text-gray-600 hover:text-green-600 ml-2">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.0669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                            WhatsApp
                        </a>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</section>

@auth
@if(auth()->user()->hasRole('Super Admin'))
<section class="section bg-sky-50">
    <div class="container">
        <div class="max-w-4xl mx-auto">
            <div class="bg-sky-100 border border-sky-200 rounded-lg p-8">
                <h3 class="text-2xl font-bold text-sky-700 mb-4">Admin Access Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h4 class="font-semibold text-gray-900 mb-4">Admin Panel URL</h4>
                        <code class="bg-gray-100 px-3 py-2 rounded block text-sm">{{ url('/admin') }}</code>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h4 class="font-semibold text-gray-900 mb-4">Admin Credentials</h4>
                        <div class="space-y-2 text-sm">
                            <p><strong>Username:</strong> admin@lafatour.com</p>
                            <p><strong>Password:</strong> MVa8jK9Fp2puI2aB8turfs</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
@endauth
@endsection
