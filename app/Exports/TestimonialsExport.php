<?php

namespace App\Exports;

use App\Models\Testimonial;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TestimonialsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $ids = null;

    public function onlyIds(array $ids): self
    {
        $this->ids = $ids;
        return $this;
    }

    public function collection()
    {
        $query = Testimonial::with('package');

        if ($this->ids) {
            $query->whereIn('id', $this->ids);
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Customer Name',
            'Package',
            'Rating',
            'Review',
            'Travel Date',
            'Approved',
            'Featured',
            'Created At',
        ];
    }

    public function map($testimonial): array
    {
        return [
            $testimonial->id,
            $testimonial->customer_name,
            $testimonial->package ? $testimonial->package->name : 'N/A',
            $testimonial->rating,
            $testimonial->review,
            $testimonial->travel_date ? $testimonial->travel_date->format('Y-m-d') : 'N/A',
            $testimonial->is_approved ? 'Yes' : 'No',
            $testimonial->is_featured ? 'Yes' : 'No',
            $testimonial->created_at->format('Y-m-d H:i:s'),
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
