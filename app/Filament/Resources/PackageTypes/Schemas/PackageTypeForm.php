<?php

namespace App\Filament\Resources\PackageTypes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PackageTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Package Type Name')
                    ->required()
                    ->maxLength(255)
                    ->helperText('e.g., Umroh, Haji, Umroh Plus, Haji Furoda'),
                TextInput::make('slug')
                    ->label('URL Slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->alphaDash()
                    ->helperText('Used in URLs, e.g., umroh, haji-plus'),
                Textarea::make('description')
                    ->label('Description')
                    ->rows(3)
                    ->helperText('Brief description of this package type')
                    ->columnSpanFull(),
                Select::make('icon')
                    ->label('Icon')
                    ->options([
                        'heroicon-o-building-office' => 'Building Office (Umroh)',
                        'heroicon-o-star' => 'Star (Haji)',
                        'heroicono-globe-alt' => 'Globe (International)',
                        'heroicon-o-sparkles' => 'Sparkles (Premium)',
                        'heroicon-o-academic-cap' => 'Academic Cap (Special)',
                        'heroicon-o-map' => 'Map (Travel)',
                        'heroicono-home' => 'Home (Domestic)',
                        'heroicono-airplane' => 'Airplane (Flight)',
                    ])
                    ->searchable()
                    ->default('heroicono-building-office')
                    ->helperText('Select an icon for this package type'),
            ]);
    }
}
