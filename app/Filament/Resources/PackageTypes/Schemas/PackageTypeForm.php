<?php

namespace App\Filament\Resources\PackageTypes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
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
                    ->helperText('Select an icon for this package type'),
                Select::make('color')
                    ->label('Color Badge')
                    ->options([
                        'primary' => 'Blue (Primary)',
                        'success' => 'Green (Success)',
                        'warning' => 'Yellow (Warning)',
                        'danger' => 'Red (Danger)',
                        'info' => 'Cyan (Info)',
                        'gray' => 'Gray (Neutral)',
                    ])
                    ->default('primary')
                    ->required()
                    ->helperText('Color for badges and labels'),
                Toggle::make('is_active')
                    ->label('Active')
                    ->default(true)
                    ->inline(false)
                    ->helperText('Enable this package type'),
                TextInput::make('sort_order')
                    ->label('Sort Order')
                    ->numeric()
                    ->default(0)
                    ->helperText('Lower numbers appear first'),
            ]);
    }
}
