<?php

namespace App\Exports;

use App\Models\ContactMessage;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ContactMessagesExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected array $ids = [];

    public function onlyIds(array $ids): self
    {
        $this->ids = $ids;
        return $this;
    }

    public function collection()
    {
        $query = ContactMessage::query();

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
            'Email',
            'Phone',
            'WhatsApp',
            'Subject',
            'Message',
            'Read',
            'Replied',
            'IP Address',
            'Created At',
        ];
    }

    public function map($message): array
    {
        return [
            $message->id,
            $message->name,
            $message->email,
            $message->phone ?: '-',
            $message->whatsapp ?: '-',
            $message->subject,
            strip_tags($message->message),
            $message->is_read ? 'Yes' : 'No',
            $message->is_replied ? 'Yes' : 'No',
            $message->ip_address ?: '-',
            $message->created_at->format('M j, Y H:i'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'size' => 12],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4F46E5'],
                ],
                'font' => ['color' => ['rgb' => 'FFFFFF']],
            ],
        ];
    }
}
