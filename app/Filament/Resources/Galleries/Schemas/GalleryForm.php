<?php

namespace App\Filament\Resources\Galleries\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class GalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->rows(3)
                    ->columnSpanFull(),
                FileUpload::make('image_path')
                    ->label('Gallery Image')
                    ->image()
                    ->imageEditor()
                    ->directory('uploads/gallery')
                    ->disk('public')
                    ->visibility('public')
                    ->maxSize(5120)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'])
                    ->required()
                    ->helperText('Upload image (max 5MB)'),
                FileUpload::make('thumbnail_path')
                    ->label('Thumbnail (optional)')
                    ->image()
                    ->directory('uploads/gallery/thumbnails')
                    ->disk('public')
                    ->visibility('public')
                    ->maxSize(2048)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg', 'image/webp']),
                Select::make('category')
                    ->options([
                        'umroh' => 'Umroh',
                        'haji' => 'Haji',
                        'activity' => 'Activity',
                        'office' => 'Office',
                        'team' => 'Team',
                    ])
                    ->default('umroh')
                    ->required(),
                Select::make('package_id')
                    ->label('Related Package')
                    ->relationship('package', 'name')
                    ->searchable()
                    ->preload()
                    ->placeholder('Select a package (optional)'),
                TextInput::make('alt_text')
                    ->label('Alt Text')
                    ->helperText('Description for screen readers'),
                TextInput::make('video_url')
                    ->label('Video URL')
                    ->url()
                    ->placeholder('https://youtube.com/watch?v=...'),
                Toggle::make('is_video')
                    ->label('Is Video?')
                    ->inline(false)
                    ->default(false),
                Toggle::make('is_active')
                    ->label('Active')
                    ->inline(false)
                    ->default(true),
            ]);
    }
}
