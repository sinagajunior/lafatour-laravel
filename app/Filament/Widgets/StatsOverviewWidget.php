<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\Models\Package;
use App\Models\Testimonial;
use App\Models\BlogPost;
use App\Models\Gallery;
use App\Models\ContactMessage;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected static bool $isLazyLoaded = false;

    public function getStats(): array
    {
        // Booking stats
        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('booking_status', 'pending')->count();
        $confirmedBookings = Booking::where('booking_status', 'confirmed')->count();
        $paidBookings = Booking::where('booking_status', 'paid')->count();

        // Revenue stats
        $totalRevenue = Booking::whereIn('booking_status', ['confirmed', 'paid'])
            ->sum(DB::raw('COALESCE(total_amount, 0)'));
        $pendingRevenue = Booking::where('booking_status', 'pending')
            ->sum(DB::raw('COALESCE(total_amount, 0)'));

        // Package stats
        $totalPackages = Package::count();
        $activePackages = Package::active()->count();
        $featuredPackages = Package::active()->featured()->count();

        // Content stats
        $totalTestimonials = Testimonial::count();
        $approvedTestimonials = Testimonial::approved()->count();
        $featuredTestimonials = Testimonial::approved()->featured()->count();

        $publishedPosts = BlogPost::published()->count();
        $totalGalleries = Gallery::count();
        $unreadMessages = ContactMessage::where('is_read', false)->count();

        // Time-based stats
        $thisMonthBookings = Booking::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $lastMonthBookings = Booking::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();

        $growth = $lastMonthBookings > 0
            ? round((($thisMonthBookings - $lastMonthBookings) / $lastMonthBookings) * 100, 1)
            : 0;

        return [
            // Primary Stats
            Stat::make('Total Bookings', $totalBookings)
                ->description($pendingBookings . ' pending • ' . $confirmedBookings . ' confirmed')
                ->descriptionIcon('heroicon-o-clipboard-document-list')
                ->color('warning')
                ->chart([7, 12, 10, 14, 8, 15, $thisMonthBookings]),

            Stat::make('Active Packages', $activePackages)
                ->description($featuredPackages . ' featured • ' . $totalPackages . ' total')
                ->descriptionIcon('heroicon-o-gift')
                ->color('success'),

            Stat::make('Total Testimonials', $approvedTestimonials)
                ->description($featuredTestimonials . ' featured • ' . $totalTestimonials . ' total')
                ->descriptionIcon('heroicon-o-star')
                ->color('primary'),

            // Secondary Stats
            Stat::make('Total Revenue', 'IDR ' . number_format($totalRevenue, 0, ',', '.'))
                ->description('IDR ' . number_format($pendingRevenue, 0, ',', '.') . ' pending')
                ->descriptionIcon('heroicon-o-banknotes')
                ->color('success'),

            Stat::make('Paid Bookings', $paidBookings)
                ->description('Fully paid customers')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),

            Stat::make('This Month', $thisMonthBookings)
                ->description(($growth >= 0 ? '+' : '') . $growth . '% vs last month')
                ->descriptionIcon('heroicon-o-calendar-days')
                ->color($growth >= 0 ? 'success' : 'danger'),

            // Content Stats
            Stat::make('Blog Posts', $publishedPosts)
                ->description('Published articles')
                ->descriptionIcon('heroicon-o-newspaper')
                ->color('info'),

            Stat::make('Gallery Images', $totalGalleries)
                ->description('Photos uploaded')
                ->descriptionIcon('heroicon-o-photo')
                ->color('info'),

            Stat::make('Unread Messages', $unreadMessages)
                ->description('Contact inquiries')
                ->descriptionIcon('heroicon-o-envelope')
                ->color($unreadMessages > 0 ? 'warning' : 'success'),
        ];
    }
}
