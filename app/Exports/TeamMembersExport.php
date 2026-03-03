<?php

namespace App\Exports;

use App\Models\TeamMember;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TeamMembersExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $ids = null;

    public function onlyIds(array $ids): self
    {
        $this->ids = $ids;
        return $this;
    }

    public function collection()
    {
        $query = TeamMember::query();

        if ($this->ids) {
            $query->whereIn('id', $this->ids);
        }

        return $query->orderBy('sort_order', 'asc')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Position',
            'Department',
            'Email',
            'WhatsApp',
            'Experience (Years)',
            'Active',
            'Featured',
            'Created At',
        ];
    }

    public function map($member): array
    {
        return [
            $member->id,
            $member->name,
            $member->position,
            ucfirst($member->department),
            $member->email,
            $member->whatsapp,
            $member->experience_years,
            $member->is_active ? 'Yes' : 'No',
            $member->is_featured ? 'Yes' : 'No',
            $member->created_at->format('Y-m-d H:i:s'),
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
