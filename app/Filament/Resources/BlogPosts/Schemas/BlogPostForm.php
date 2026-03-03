<?php

namespace App\Filament\Resources\BlogPosts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BlogPostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('excerpt'),
                FileUpload::make('featured_image')
                    ->label('Featured Image')
                    ->image()
                    ->directory('uploads/blog')
                    ->disk('public')
                    ->visibility('public')
                    ->maxSize(5120)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'])
                    ->helperText('Upload a featured image for the blog post (max 5MB)')
                    ->columnSpanFull(),
                TextInput::make('category')
                    ->required()
                    ->default('news'),
                TextInput::make('tags'),
                TextInput::make('author_id')
                    ->numeric()
                    ->default(1),
                Toggle::make('is_published')
                    ->required()
                    ->live()
                    ->default(true)
                    ->helperText('When enabled, post will be visible on frontend'),
                DateTimePicker::make('published_at')
                    ->default(now())
                    ->helperText('Defaults to current time when post is published')
                    ->seconds(false),
                TextInput::make('meta_title'),
                TextInput::make('meta_description'),
                TextInput::make('view_count')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
