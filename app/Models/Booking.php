<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'lafatour_bookings';

    protected $fillable = [
        'booking_number',
        'package_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_whatsapp',
        'customer_address',
        'id_card_number',
        'birth_date',
        'gender',
        'emergency_contact_name',
        'emergency_contact_phone',
        'family_info',
        'payment_status',
        'booking_status',
        'total_amount',
        'down_payment',
        'down_payment_amount',
        'remaining_payment',
        'down_payment_due',
        'full_payment_due',
        'down_payment_paid_at',
        'full_payment_paid_at',
        'payment_method',
        'payment_proof',
        'special_requests',
        'admin_notes',
        'documents',
        'confirmed_at',
        'confirmed_by',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'down_payment_due' => 'date',
        'full_payment_due' => 'date',
        'down_payment_paid_at' => 'date',
        'full_payment_paid_at' => 'date',
        'confirmed_at' => 'datetime',
        'total_amount' => 'decimal:2',
        'down_payment' => 'decimal:2',
        'down_payment_amount' => 'decimal:2',
        'remaining_payment' => 'decimal:2',
        'family_info' => 'array',
        'payment_proof' => 'array',
        'documents' => 'array',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function confirmedByUser()
    {
        return $this->belongsTo(User::class, 'confirmed_by');
    }

    public function scopePending($query)
    {
        return $query->where('booking_status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('booking_status', 'confirmed');
    }

    public function scopeProcessing($query)
    {
        return $query->where('booking_status', 'processing');
    }

    public function scopeCompleted($query)
    {
        return $query->where('booking_status', 'completed');
    }

    public function scopeCancelled($query)
    {
        return $query->where('booking_status', 'cancelled');
    }

    public function scopePaymentPending($query)
    {
        return $query->where('payment_status', 'pending');
    }

    public function scopeDownPayment($query)
    {
        return $query->where('payment_status', 'down_payment');
    }

    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }

    public static function generateBookingNumber()
    {
        $prefix = 'LF' . date('Ymd');
        $lastBooking = self::where('booking_number', 'like', $prefix . '%')
            ->orderBy('id', 'desc')
            ->first();

        if ($lastBooking) {
            $lastNumber = (int) substr($lastBooking->booking_number, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        return $prefix . $newNumber;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->booking_number)) {
                $model->booking_number = self::generateBookingNumber();
            }
        });
    }

    public function getFormattedTotalAmountAttribute()
    {
        return 'IDR ' . number_format($this->total_amount, 0, ',', '.');
    }

    public function getPaymentStatusLabelAttribute()
    {
        return [
            'pending' => 'Menunggu Pembayaran',
            'down_payment' => 'Uang Muka',
            'paid' => 'Lunas',
            'overdue' => 'Terlambat Bayar',
        ][$this->payment_status] ?? $this->payment_status;
    }

    public function getBookingStatusLabelAttribute()
    {
        return [
            'pending' => 'Menunggu Konfirmasi',
            'confirmed' => 'Dikonfirmasi',
            'processing' => 'Diproses',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
        ][$this->booking_status] ?? $this->booking_status;
    }
}
