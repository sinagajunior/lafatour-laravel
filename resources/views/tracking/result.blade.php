@extends('layouts.app')

@section('content')
@section('page_title', 'Status Pemesanan')

<div class="section bg-sky-700 text-white py-16">
    <div class="container text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Status Pemesanan</h1>
        <p class="text-sky-100 text-lg max-w-2xl mx-auto">
            Berikut adalah detail status pemesanan Anda
        </p>
    </div>
</div>

@if(isset($booking))
<section class="section">
    <div class="container">
        <div class="max-w-4xl mx-auto">
            <div class="card bg-white p-8 rounded-xl shadow-sm">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl font-bold text-gray-900">{{ $booking->booking_number }}</h2>
                    <span class="px-4 py-2 rounded-full text-sm font-semibold
                                 {{ $booking->booking_status == 'confirmed' ? 'bg-green-100 text-green-700' :
                                   ($booking->booking_status == 'pending' ? 'bg-yellow-100 text-yellow-700' :
                                   ($booking->booking_status == 'completed' ? 'bg-blue-100 text-blue-700' :
                                   'bg-red-100 text-red-700') }}">
                        {{ $booking->booking_status_label }}
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Jamaah</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between py-2 border-b">
                                <span class="text-gray-600">Nama</span>
                                <span class="font-medium">{{ $booking->customer_name }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b">
                                <span class="text-gray-600">Email</span>
                                <span class="font-medium">{{ $booking->customer_email }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b">
                                <span class="text-gray-600">Telepon</span>
                                <span class="font-medium">{{ $booking->customer_phone }}</span>
                            </div>
                            <div class="flex justify-between py-2">
                                <span class="text-gray-600">WhatsApp</span>
                                <span class="font-medium">{{ $booking->customer_whatsapp }}</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Paket</h3>
                        @if($booking->package)
                        <div class="space-y-3">
                            <div class="flex justify-between py-2 border-b">
                                <span class="text-gray-600">Paket</span>
                                <span class="font-medium">{{ $booking->package->name }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b">
                                <span class="text-gray-600">Durasi</span>
                                <span class="font-medium">{{ $booking->package->duration }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b">
                                <span class="text-gray-600">Keberangkatan</span>
                                <span class="font-medium">
                                    {{ $booking->package->departure_date ? $booking->package->departure_date->format('d F Y') : 'TBA' }}
                                </span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="mt-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Status Pembayaran</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between py-2 border-b">
                            <span class="text-gray-600">Status</span>
                            <span class="font-medium {{ $booking->payment_status == 'paid' ? 'text-green-600' : 'text-yellow-600' }}">
                                {{ $booking->payment_status_label }}
                            </span>
                        </div>
                        <div class="flex justify-between py-2 border-b">
                            <span class="text-gray-600">Total</span>
                            <span class="font-medium">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</span>
                        </div>
                        @if($booking->down_payment_amount > 0)
                        <div class="flex justify-between py-2 border-b">
                            <span class="text-gray-600">Uang Muka</span>
                            <span class="font-medium">Rp {{ number_format($booking->down_payment_amount, 0, ',', '.') }}</span>
                        </div>
                        @endif
                        <div class="flex justify-between py-2">
                            <span class="text-gray-600">Sisa Pembayaran</span>
                            <span class="font-medium">Rp {{ number_format($booking->remaining_payment, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <div class="mt-8 p-4 bg-sky-50 rounded-lg">
                    <h3 class="font-semibold text-gray-900 mb-2">Timeline Status</h3>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <div class="w-3 h-3 {{ $booking->created_at ? 'bg-green-500' : 'bg-gray-300' }} rounded-full mr-3"></div>
                            <span class="text-sm">Booking dibuat</span>
                            <span class="ml-auto text-sm text-gray-500">
                                {{ $booking->created_at ? $booking->created_at->format('d M Y, H:i') : '-' }}
                            </span>
                        </div>
                        @if($booking->confirmed_at)
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                            <span class="text-sm">Booking dikonfirmasi</span>
                            <span class="ml-auto text-sm text-gray-500">
                                {{ $booking->confirmed_at->format('d M Y, H:i') }}
                            </span>
                        </div>
                        @endif
                        @if($booking->booking_status == 'completed')
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                            <span class="text-sm">Perjalanan selesai</span>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="mt-8 text-center">
                    <a href="https://wa.me/6281290001885?text=Halo%20LaFatour,%20saya%20ingin%20bertanya%20tentang%20booking%20{{ $booking->booking_number }}"
                       target="_blank"
                       class="inline-flex items-center bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg font-medium transition">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.0669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        Hubungi via WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
@endsection
