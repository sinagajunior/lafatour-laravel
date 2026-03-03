<?php

namespace App\Filament\Resources\Packages\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PackageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                Textarea::make('highlights')
                    ->columnSpanFull(),
                Select::make('package_type_id')
                    ->label('Package Type')
                    ->relationship('packageType', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->helperText('Select the package type (managed in Package Types)'),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->default(0.0)
                    ->prefix('$'),
                TextInput::make('early_bird_price')
                    ->numeric()
                    ->prefix('$'),
                DatePicker::make('early_bird_until'),
                TextInput::make('duration_days')
                    ->required()
                    ->numeric()
                    ->default(9),
                DatePicker::make('departure_date'),
                DatePicker::make('return_date'),
                TextInput::make('quota')
                    ->required()
                    ->numeric()
                    ->default(40),
                TextInput::make('seats_available')
                    ->required()
                    ->numeric()
                    ->default(40),
                TextInput::make('hotel_mekkah')
                    ->tel(),
                TextInput::make('hotel_madinah')
                    ->tel(),
                TextInput::make('airline'),
                Toggle::make('includes_hotel')
                    ->required(),
                Toggle::make('includes_flight')
                    ->required(),
                Toggle::make('includes_visa')
                    ->required(),
                Toggle::make('includes_meals')
                    ->required(),
                Toggle::make('includes_guide')
                    ->required(),
                Textarea::make('inclusions')
                    ->columnSpanFull(),
                Textarea::make('exclusions')
                    ->columnSpanFull(),
                FileUpload::make('featured_image')
                    ->label('Featured Image')
                    ->image()
                    ->directory('uploads/packages')
                    ->disk('public')
                    ->visibility('public')
                    ->maxSize(5120)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'])
                    ->helperText('Upload a featured image for the package (max 5MB)')
                    ->columnSpanFull(),
                TextInput::make('gallery_images'),
                TextInput::make('meta_title'),
                TextInput::make('meta_description'),
                Toggle::make('is_featured')
                    ->required(),
                Toggle::make('is_active')
                    ->required(),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
