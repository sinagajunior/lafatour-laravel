<?php

namespace App\Filament\Resources\PackageTypes\Pages;

use App\Filament\Resources\PackageTypes\PackageTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPackageTypes extends ListRecords
{
    protected static string $resource = PackageTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
