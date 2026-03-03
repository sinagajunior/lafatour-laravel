@extends('layouts.app')

@section('content')
@section('page_title', 'Daftar Sekarang')

<div class="section bg-sky-700 text-white py-16">
    <div class="container text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Daftar Sekarang</h1>
        <p class="text-sky-100 text-lg max-w-2xl mx-auto">
            Mulai perjalanan ibadah Anda dengan mudah dan aman
        </p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="max-w-3xl mx-auto">
            <div class="card bg-white p-8 rounded-xl shadow-sm">
                @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
                @endif

                <form method="POST" action="{{ route('booking.store') }}" class="space-y-6">
                    @csrf

                    <!-- Package Selection -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Paket *</label>
                        <select name="package_id" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent"
                                onchange="updatePackageInfo(this.value)">
                            <option value="">-- Pilih Paket --</option>
                            @foreach($packages as $pkg)
                            <option value="{{ $pkg->id }}" {{ $package && $package->id == $pkg->id ? 'selected' : '' }}>
                                {{ $pkg->name }} - Rp {{ number_format($pkg->price, 0, ',', '.') }} ({{ $pkg->duration }})
                            </option>
                            @endforeach
                        </select>
                        @error('package_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    @if($package)
                    <div class="bg-sky-50 p-4 rounded-lg mb-6">
                        <h3 class="font-semibold text-gray-900 mb-2">{{ $package->name }}</h3>
                        <div class="text-sm text-gray-600 space-y-1">
                            <p><strong>Durasi:</strong> {{ $package->duration }}</p>
                            <p><strong>Keberangkatan:</strong> {{ $package->departure_date ? $package->departure_date->format('d F Y') : 'TBA' }}</p>
                            <p><strong>Harga:</strong> Rp {{ number_format($package->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Personal Information -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pribadi</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap *</label>
                                <input type="text" name="customer_name" required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent"
                                       placeholder="Nama lengkap sesuai KTP">
                                @error('customer_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                                <input type="email" name="customer_email" required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent"
                                       placeholder="email@example.com">
                                @error('customer_email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon *</label>
                                <input type="tel" name="customer_phone" required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent"
                                       placeholder="08123456789">
                                @error('customer_phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">No. WhatsApp *</label>
                                <input type="tel" name="customer_whatsapp" required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent"
                                       placeholder="08123456789">
                                @error('customer_whatsapp')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                            <textarea name="customer_address" rows="2"
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent"
                                      placeholder="Alamat lengkap"></textarea>
                        </div>
                    </div>

                    <!-- ID Information -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Identitas</h3>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">No. KTP *</label>
                                <input type="text" name="id_card_number" required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent"
                                       placeholder="16 digit nomor KTP">
                                @error('id_card_number')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                                <input type="date" name="birth_date"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                                <select name="gender"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent">
                                    <option value="">Pilih</option>
                                    <option value="male">Laki-laki</option>
                                    <option value="female">Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Emergency Contact -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Kontak Darurat</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kontak Darurat</label>
                                <input type="text" name="emergency_contact_name"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent"
                                       placeholder="Nama lengkap">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon Darurat</label>
                                <input type="tel" name="emergency_contact_phone"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent"
                                       placeholder="08123456789">
                            </div>
                        </div>
                    </div>

                    <!-- Special Requests -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Permintaan Khusus</label>
                        <textarea name="special_requests" rows="3"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent"
                                  placeholder="Ada permintaan khusus? (Opsional)"></textarea>
                    </div>

                    <!-- Terms & Conditions -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="flex items-start">
                            <input type="checkbox" required class="mt-1 mr-3">
                            <span class="text-sm text-gray-700">
                                Saya menyetujui bahwa data yang saya berikan adalah benar dan saya menyetujui untuk mematuhi syarat dan ketentuan yang berlaku.
                            </span>
                        </label>
                    </div>

                    <button type="submit"
                            class="w-full bg-sky-500 hover:bg-sky-600 text-white px-6 py-4 rounded-lg font-semibold text-lg transition shadow-md hover:shadow-lg">
                        Daftar Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
function updatePackageInfo(packageId) {
    // Could add AJAX to fetch package details and update price display
    console.log('Selected package:', packageId);
}
</script>
@endsection
