<?php

namespace App\Http\Controllers;

use App\Exports\GalleriesExport;
use App\Exports\PackagesExport;
use App\Exports\BookingsExport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportController
{
    public function galleries($category = null): BinaryFileResponse
    {
        return Excel::download(new GalleriesExport($category), 'galleries-' . date('Y-m-d-His') . '.xlsx');
    }

    public function packages($type = null): BinaryFileResponse
    {
        return Excel::download(new PackagesExport($type), 'packages-' . date('Y-m-d-His') . '.xlsx');
    }

    public function bookings($status = null): BinaryFileResponse
    {
        return Excel::download(new BookingsExport($status), 'bookings-' . date('Y-m-d-His') . '.xlsx');
    }
}
