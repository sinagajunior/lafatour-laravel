@extends('layouts.app')

@section('content')
@section('page_title', 'FAQ')

<div class="section bg-sky-700 text-white py-16">
    <div class="container text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Frequently Asked Questions</h1>
        <p class="text-sky-100 text-lg max-w-2xl mx-auto">
            Temukan jawaban untuk pertanyaan umum seputar Umroh dan Haji
        </p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="max-w-4xl mx-auto">
            <div class="space-y-4" x-data="{ open: null }">
                <!-- General Questions -->
                <div class="card bg-white rounded-xl shadow-sm overflow-hidden">
                    <h3 class="text-lg font-semibold p-4 cursor-pointer hover:bg-gray-50 flex justify-between items-center"
                        @click="open = open === 'general' ? null : 'general'">
                        <span>Pertanyaan Umum</span>
                        <svg class="w-5 h-5 transition-transform" :class="open === 'general' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </h3>
                    <div x-show="open === 'general'" class="p-4 space-y-4">
                        <div class="border-b pb-4">
                            <h4 class="font-medium text-gray-900 mb-2">Apa itu LaFatour?</h4>
                            <p class="text-gray-600 text-sm">LaFatour adalah biro perjalanan ibadah Umroh dan Haji yang berdiri sejak 2015. Kami melayani jamaah Indonesia dengan sepenuh hati dan profesional.</p>
                        </div>

                        <div class="border-b pb-4">
                            <h4 class="font-medium text-gray-900 mb-2">Apakah LaFatour resmi dan terdaftar?</h4>
                            <p class="text-gray-600 text-sm">Ya, LaFatour adalah biro perjalanan resmi yang terdaftar dan memiliki izin operasional lengkap untuk melayani jamaah Umroh dan Haji.</p>
                        </div>

                        <div>
                            <h4 class="font-medium text-gray-900 mb-2">Bagaimana cara membooking paket?</h4>
                            <p class="text-gray-600 text-sm">Anda bisa membooking melalui website kami dengan mengisi formulir pendaftaran atau menghubungi kami via WhatsApp di +62 81290001885.</p>
                        </div>
                    </div>
                </div>

                <!-- Umroh Questions -->
                <div class="card bg-white rounded-xl shadow-sm overflow-hidden">
                    <h3 class="text-lg font-semibold p-4 cursor-pointer hover:bg-gray-50 flex justify-between items-center"
                        @click="open = open === 'umroh' ? null : 'umroh'">
                        <span>Pertanyaan Umroh</span>
                        <svg class="w-5 h-5 transition-transform" :class="open === 'umroh' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </h3>
                    <div x-show="open === 'umroh'" class="p-4 space-y-4">
                        <div class="border-b pb-4">
                            <h4 class="font-medium text-gray-900 mb-2">Berapa lama perjalanan Umroh?</h4>
                            <p class="text-gray-600 text-sm">Paket Umroh kami biasanya 9-12 hari, tergantung jenis paket yang dipilih. Paket Umroh Plus bisa lebih lama karena kunjungan wisata.</p>
                        </div>

                        <div class="border-b pb-4">
                            <h4 class="font-medium text-gray-900 mb-2">Apa saja yang termasuk dalam paket Umroh?</h4>
                            <p class="text-gray-600 text-sm">Paket Umroh kami biasanya termasuk tiket pesawat PP, visa, akomodasi hotel dekat Haram, makan 3x sehari, transportasi, dan pemandu mutawwif berbahasa Indonesia.</p>
                        </div>
                    </div>
                </div>

                <!-- Payment Questions -->
                <div class="card bg-white rounded-xl shadow-sm overflow-hidden">
                    <h3 class="text-lg font-semibold p-4 cursor-pointer hover:bg-gray-50 flex justify-between items-center"
                        @click="open = open === 'payment' ? null : 'payment'">
                        <span>Pembayaran</span>
                        <svg class="w-5 h-5 transition-transform" :class="open === 'payment' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </h3>
                    <div x-show="open === 'payment'" class="p-4 space-y-4">
                        <div class="border-b pb-4">
                            <h4 class="font-medium text-gray-900 mb-2">Bagaimana cara pembayarannya?</h4>
                            <p class="text-gray-600 text-sm">Anda bisa melakukan pembayaran melalui transfer bank, kartu kredit, atau pembayaran langsung di kantor kami. Kami juga menerima pembayaran cicilan.</p>
                        </div>

                        <div class="border-b pb-4">
                            <h4 class="font-medium text-gray-900 mb-2">Berapa uang muka yang harus dibayar?</h4>
                            <p class="texttext-gray-600 text-sm">Uang muka minimal 30% dari total biaya, harus dilunasi dalam 3x24 jam setelah booking.</p>
                        </div>

                        <div>
                            <h4 class="font-medium text-gray-900 mb-2">Apakah ada diskon?</h4>
                            <p class="text-gray-600 text-sm">Ya, kami sering menawarkan promo early bird dengan harga spesial untuk pendaftaran jauh hari. Ada juga diskon group untuk pendaftaran lebih dari 5 jamaah.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-12 text-center">
                <p class="text-gray-600 mb-4">Masih memiliki pertanyaan?</p>
                <a href="{{ route('contact') }}" class="inline-flex items-center bg-sky-500 hover:bg-sky-600 text-white px-6 py-3 rounded-lg font-medium transition">
                    Hubungi Kami
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4h.01M9 12h.01"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
