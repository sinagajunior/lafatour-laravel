<?php

namespace Tests\Feature\Models;

use App\Models\Package;
use App\Models\PackageItinerary;
use App\Models\Gallery;
use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;
use Tests\TestCase;

class PackageTest extends TestCase
{
    use RefreshDatabase;

    public function test_package_can_be_created(): void
    {
        $package = Package::create([
            'name' => 'Umroh Reguler',
            'slug' => 'umroh-reguler',
            'type' => 'umroh',
            'price' => 15000000,
            'duration_days' => 9,
            'departure_date' => Carbon::now()->addMonth(),
            'return_date' => Carbon::now()->addMonth()->addDays(9),
            'quota' => 40,
            'seats_available' => 40,
            'is_featured' => true,
            'is_active' => true,
        ]);

        $this->assertDatabaseHas('lafatour_packages', [
            'name' => 'Umroh Reguler',
            'type' => 'umroh',
        ]);
    }

    public function test_package_has_many_itineraries(): void
    {
        $package = Package::create([
            'name' => 'Umroh Reguler',
            'slug' => 'umroh-reguler',
            'type' => 'umroh',
            'price' => 15000000,
            'duration_days' => 9,
            'quota' => 40,
            'is_active' => true,
        ]);

        $itinerary = PackageItinerary::create([
            'package_id' => $package->id,
            'day_number' => 1,
            'title' => 'Arrival in Jeddah',
            'description' => 'Meet and greet at Jeddah airport',
        ]);

        $this->assertCount(1, $package->itineraries);
        $this->assertEquals('Arrival in Jeddah', $package->itineraries->first()->title);
    }

    public function test_package_has_many_galleries(): void
    {
        $package = Package::create([
            'name' => 'Umroh Reguler',
            'slug' => 'umroh-reguler',
            'type' => 'umroh',
            'price' => 15000000,
            'duration_days' => 9,
            'quota' => 40,
            'is_active' => true,
        ]);

        Gallery::create([
            'title' => 'Kaabah Photo',
            'image_path' => 'uploads/gallery/kabah.jpg',
            'category' => 'umroh',
            'package_id' => $package->id,
            'is_active' => true,
        ]);

        Gallery::create([
            'title' => 'Madina Photo',
            'image_path' => 'uploads/gallery/madina.jpg',
            'category' => 'umroh',
            'package_id' => $package->id,
            'is_active' => true,
        ]);

        $this->assertCount(2, $package->galleries);
    }

    public function test_package_has_many_bookings(): void
    {
        $package = Package::create([
            'name' => 'Umroh Reguler',
            'slug' => 'umroh-reguler',
            'type' => 'umroh',
            'price' => 15000000,
            'duration_days' => 9,
            'quota' => 40,
            'is_active' => true,
        ]);

        Booking::create([
            'booking_number' => 'B001',
            'package_id' => $package->id,
            'customer_name' => 'John Doe',
            'customer_email' => 'john@example.com',
            'customer_phone' => '08123456789',
            'customer_whatsapp' => '08123456789',
            'id_card_number' => '1234567890123456',
            'total_amount' => 15000000,
            'down_payment_amount' => 5000000,
            'remaining_payment' => 10000000,
            'payment_status' => 'down_payment',
            'booking_status' => 'pending',
        ]);

        $this->assertCount(1, $package->bookings);
    }

    public function test_active_scope(): void
    {
        Package::create([
            'name' => 'Active Package',
            'slug' => 'active-package',
            'type' => 'umroh',
            'price' => 15000000,
            'duration_days' => 9,
            'is_active' => true,
        ]);

        Package::create([
            'name' => 'Inactive Package',
            'slug' => 'inactive-package',
            'type' => 'umroh',
            'price' => 15000000,
            'duration_days' => 9,
            'is_active' => false,
        ]);

        $activePackages = Package::active()->get();

        $this->assertCount(1, $activePackages);
        $this->assertEquals('Active Package', $activePackages->first()->name);
    }

    public function test_featured_scope(): void
    {
        Package::create([
            'name' => 'Featured Package',
            'slug' => 'featured-package',
            'type' => 'umroh',
            'price' => 15000000,
            'duration_days' => 9,
            'is_featured' => true,
            'is_active' => true,
        ]);

        Package::create([
            'name' => 'Regular Package',
            'slug' => 'regular-package',
            'type' => 'umroh',
            'price' => 15000000,
            'duration_days' => 9,
            'is_featured' => false,
            'is_active' => true,
        ]);

        $featuredPackages = Package::featured()->get();

        $this->assertCount(1, $featuredPackages);
        $this->assertEquals('Featured Package', $featuredPackages->first()->name);
    }

    public function test_umroh_scope(): void
    {
        Package::create([
            'name' => 'Umroh Package',
            'slug' => 'umroh-package',
            'type' => 'umroh',
            'price' => 15000000,
            'duration_days' => 9,
            'is_active' => true,
        ]);

        Package::create([
            'name' => 'Haji Package',
            'slug' => 'haji-package',
            'type' => 'haji',
            'price' => 25000000,
            'duration_days' => 25,
            'is_active' => true,
        ]);

        $umrohPackages = Package::umroh()->get();

        $this->assertCount(1, $umrohPackages);
        $this->assertEquals('Umroh Package', $umrohPackages->first()->name);
    }

    public function test_haji_scope(): void
    {
        Package::create([
            'name' => 'Umroh Package',
            'slug' => 'umroh-package',
            'type' => 'umroh',
            'price' => 15000000,
            'duration_days' => 9,
            'is_active' => true,
        ]);

        Package::create([
            'name' => 'Haji Package',
            'slug' => 'haji-package',
            'type' => 'haji',
            'price' => 25000000,
            'duration_days' => 25,
            'is_active' => true,
        ]);

        $hajiPackages = Package::haji()->get();

        $this->assertCount(1, $hajiPackages);
        $this->assertEquals('Haji Package', $hajiPackages->first()->name);
    }

    public function test_available_scope(): void
    {
        Package::create([
            'name' => 'Available Package',
            'slug' => 'available-package',
            'type' => 'umroh',
            'price' => 15000000,
            'duration_days' => 9,
            'quota' => 40,
            'seats_available' => 10,
            'is_active' => true,
        ]);

        Package::create([
            'name' => 'Sold Out Package',
            'slug' => 'sold-out-package',
            'type' => 'umroh',
            'price' => 15000000,
            'duration_days' => 9,
            'quota' => 40,
            'seats_available' => null,
            'is_active' => true,
        ]);

        $availablePackages = Package::available()->get();

        $this->assertGreaterThanOrEqual(1, count($availablePackages));
        $this->assertEquals('Available Package', $availablePackages->first()->name);
    }

    public function test_upcoming_scope_filters_upcoming_dates(): void
    {
        Package::create([
            'name' => 'Upcoming Package',
            'slug' => 'upcoming-package',
            'type' => 'umroh',
            'price' => 15000000,
            'duration_days' => 9,
            'departure_date' => Carbon::now()->addMonth(),
            'is_active' => true,
        ]);

        Package::create([
            'name' => 'Past Package',
            'slug' => 'past-package',
            'type' => 'umroh',
            'price' => 15000000,
            'duration_days' => 9,
            'departure_date' => Carbon::now()->subMonth(),
            'is_active' => true,
        ]);

        $upcomingPackages = Package::upcoming()->get();

        $this->assertCount(1, $upcomingPackages);
        $this->assertEquals('Upcoming Package', $upcomingPackages->first()->name);
    }
}
