<?php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BookingsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $status;
    protected $ids = null;

    public function __construct($status = null)
    {
        $this->status = $status;
    }

    public function onlyIds(array $ids): self
    {
        $this->ids = $ids;
        return $this;
    }

    public function collection()
    {
        $query = Booking::with('package');

        if ($this->ids) {
            $query->whereIn('id', $this->ids);
        }

        if ($this->status) {
            $query->where('booking_status', $this->status);
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'Booking Number',
            'Customer Name',
            'Email',
            'Phone',
            'WhatsApp',
            'Package',
            'Total Amount',
            'Down Payment',
            'Remaining',
            'Payment Status',
            'Booking Status',
            'Created At',
        ];
    }

    public function map($booking): array
    {
        return [
            $booking->booking_number,
            $booking->customer_name,
            $booking->customer_email,
            $booking->customer_phone,
            $booking->customer_whatsapp,
            $booking->package ? $booking->package->name : 'N/A',
            'Rp ' . number_format($booking->total_amount, 0, ',', '.'),
            'Rp ' . number_format($booking->down_payment_amount, 0, ',', '.'),
            'Rp ' . number_format($booking->remaining_payment, 0, ',', '.'),
            $booking->payment_status_label,
            $booking->booking_status_label,
            $booking->created_at->format('Y-m-d H:i:s'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'size' => 12],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '79, 70, 229']]
            ],
        ];
    }
}
