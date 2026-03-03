<?php

namespace App\Exports;

use App\Models\Gallery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class GalleriesExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $categoryId;
    protected $ids = null;

    public function __construct($categoryId = null)
    {
        $this->categoryId = $categoryId;
    }

    public function onlyIds(array $ids): self
    {
        $this->ids = $ids;
        return $this;
    }

    public function collection()
    {
        $query = Gallery::query();

        if ($this->ids) {
            $query->whereIn('id', $this->ids);
        }

        if ($this->categoryId) {
            $query->where('category', $this->categoryId);
        }

        return $query->with('package')->orderBy('sort_order')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Title',
            'Description',
            'Category',
            'Package',
            'Alt Text',
            'Is Video',
            'Sort Order',
            'Is Active',
            'Created At',
        ];
    }

    public function map($gallery): array
    {
        return [
            $gallery->id,
            $gallery->title,
            $gallery->description,
            ucfirst($gallery->category),
            $gallery->package ? $gallery->package->name : 'N/A',
            $gallery->alt_text,
            $gallery->is_video ? 'Yes' : 'No',
            $gallery->sort_order,
            $gallery->is_active ? 'Yes' : 'No',
            $gallery->created_at->format('Y-m-d H:i:s'),
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
