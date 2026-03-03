<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('customer_name')
                    ->required(),
                Select::make('package_id')
                    ->label('Related Package')
                    ->relationship(
                        name: 'package',
                        titleAttribute: 'name'
                    )
                    ->searchable()
                    ->preload()
                    ->placeholder('Select a package or leave empty')
                    ->helperText('Optional: Select the package this testimonial is for'),
                TextInput::make('rating')
                    ->required()
                    ->numeric()
                    ->default(5),
                Textarea::make('review')
                    ->required()
                    ->columnSpanFull(),
                DatePicker::make('travel_date'),
                TextInput::make('photo'),
                TextInput::make('video_url')
                    ->url(),
                Toggle::make('is_approved')
                    ->required(),
                Toggle::make('is_featured')
                    ->required(),
            ]);
    }
}
