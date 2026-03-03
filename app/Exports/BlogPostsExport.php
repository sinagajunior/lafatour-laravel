<?php

namespace App\Exports;

use App\Models\BlogPost;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BlogPostsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $ids = null;

    public function onlyIds(array $ids): self
    {
        $this->ids = $ids;
        return $this;
    }

    public function collection()
    {
        $query = BlogPost::query();

        if ($this->ids) {
            $query->whereIn('id', $this->ids);
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Title',
            'Slug',
            'Excerpt',
            'Category',
            'View Count',
            'Published',
            'Published At',
            'Created At',
        ];
    }

    public function map($post): array
    {
        return [
            $post->id,
            $post->title,
            $post->slug,
            $post->excerpt,
            ucfirst($post->category),
            $post->view_count,
            $post->is_published ? 'Yes' : 'No',
            $post->published_at ? $post->published_at->format('Y-m-d') : 'N/A',
            $post->created_at->format('Y-m-d H:i:s'),
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
