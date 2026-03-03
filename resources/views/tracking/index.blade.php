@extends('layouts.app')

@section('content')
@section('page_title', 'Cek Pemesanan')

<div class="section bg-sky-700 text-white py-16">
    <div class="container text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Cek Pemesanan</h1>
        <p class="text-sky-100 text-lg max-w-2xl mx-auto">
            Lacak status pemesanan Anda dengan mudah
        </p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="max-w-xl mx-auto">
            <div class="card bg-white p-8 rounded-xl shadow-sm">
                <form method="POST" action="{{ route('tracking.search') }}" class="space-y-6">
                    @csrf

                    @if(session('error'))
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
                        {{ session('error') }}
                    </div>
                    @endif

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Booking *</label>
                        <input type="text" name="booking_number" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent"
                               placeholder="Contoh: LF20260101001">
                        <p class="mt-1 text-sm text-gray-500">Nomor booking tertera di email konfirmasi</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email Pendaftaran *</label>
                        <input type="email" name="customer_email" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent"
                               placeholder="email@example.com">
                        <p class="mt-1 text-sm text-gray-500">Email yang digunakan saat mendaftar</p>
                    </div>

                    <button type="submit"
                            class="w-full bg-sky-500 hover:bg-sky-600 text-white px-6 py-3 rounded-lg font-semibold transition shadow-md hover:shadow-lg">
                        Cek Status
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-500 mb-2">Belum punya nomor booking?</p>
                    <a href="{{ route('booking.create') }}" class="text-sky-600 hover:text-sky-700 font-medium">
                        Daftar Sekarang →
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
