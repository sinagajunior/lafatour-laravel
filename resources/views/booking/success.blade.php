@extends('layouts.app')

@section('content')
@section('page_title', 'Booking Successful')

<div class="section bg-green-600 text-white py-16">
    <div class="container text-center">
        <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Booking Successful!</h1>
        <p class="text-green-100 text-lg max-w-2xl mx-auto">
            Terima kasih telah mendaftar. Kami akan segera menghubungi Anda untuk konfirmasi selanjutnya.
        </p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="max-w-2xl mx-auto">
            <div class="card bg-white p-8 rounded-xl shadow-sm">
                <h2 class="text-2xl font-bold mb-6 text-gray-900">Booking Details</h2>

                <div class="space-y-4">
                    <div class="flex justify-between py-3 border-b">
                        <span class="text-gray-600">Nomor Booking</span>
                        <span class="font-semibold text-sky-600">{{ $booking->booking_number }}</span>
                    </div>

                    <div class="flex justify-between py-3 border-b">
                        <span class="text-gray-600">Nama</span>
                        <span class="font-semibold">{{ $booking->customer_name }}</span>
                    </div>

                    @if($booking->package)
                    <div class="flex justify-between py-3 border-b">
                        <span class="text-gray-600">Paket</span>
                        <span class="font-semibold">{{ $booking->package->name }}</span>
                    </div>
                    @endif

                    <div class="flex justify-between py-3 border-b">
                        <span class="text-gray-600">Total Biaya</span>
                        <span class="font-semibold text-sky-600">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</span>
                    </div>

                    <div class="flex justify-between py-3 border-b">
                        <span class="text-gray-600">Uang Muka (30%)</span>
                        <span class="font-semibold text-amber-600">Rp {{ number_format($booking->down_payment_amount, 0, ',', '.') }}</span>
                    </div>

                    <div class="flex justify-between py-3">
                        <span class="text-gray-600">Sisa Pembayaran</span>
                        <span class="font-semibold">Rp {{ number_format($booking->remaining_payment, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="mt-8 p-4 bg-sky-50 rounded-lg">
                    <h3 class="font-semibold text-gray-900 mb-2">Langkah Selanjutnya:</h3>
                    <ol class="list-decimal list-inside text-gray-700 space-y-2 text-sm">
                        <li>Periksa email Anda untuk detail pembayaran</li>
                        <li>Lakukan pembayaran uang muka dalam 3x24 jam</li>
                        <li>Kami akan menghubungi Anda untuk konfirmasi</li>
                        <li>Dokumen lengkap akan dikirim via email</li>
                    </ol>
                </div>

                <div class="mt-8 flex gap-4">
                    <a href="https://wa.me/6281290001885?text=Halo%20LaFatour,%20saya%20ingin%20konfirmasi%20booking%20{{ $booking->booking_number }}"
                       target="_blank"
                       class="flex-1 text-center bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg font-medium transition">
                        Hubungi via WhatsApp
                    </a>
                    <a href="{{ route('home') }}"
                       class="flex-1 text-center bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-lg font-medium transition">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
