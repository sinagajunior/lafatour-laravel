<?php

namespace App\Exports;

use App\Models\Package;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PackagesExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $type;
    protected $ids = null;

    public function __construct($type = null)
    {
        $this->type = $type;
    }

    public function onlyIds(array $ids): self
    {
        $this->ids = $ids;
        return $this;
    }

    public function collection()
    {
        $query = Package::query();

        if ($this->ids) {
            $query->whereIn('id', $this->ids);
        }

        if ($this->type) {
            $query->where('type', $this->type);
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Slug',
            'Type',
            'Price',
            'Duration',
            'Departure Date',
            'Return Date',
            'Quota',
            'Seats Available',
            'Airline',
            'Is Featured',
            'Is Active',
            'Created At',
        ];
    }

    public function map($package): array
    {
        return [
            $package->id,
            $package->name,
            $package->slug,
            ucfirst($package->type),
            'Rp ' . number_format($package->price, 0, ',', '.'),
            $package->duration,
            $package->departure_date ? $package->departure_date->format('Y-m-d') : 'N/A',
            $package->return_date ? $package->return_date->format('Y-m-d') : 'N/A',
            $package->quota,
            $package->seats_available,
            $package->airline,
            $package->is_featured ? 'Yes' : 'No',
            $package->is_active ? 'Yes' : 'No',
            $package->created_at->format('Y-m-d H:i:s'),
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
