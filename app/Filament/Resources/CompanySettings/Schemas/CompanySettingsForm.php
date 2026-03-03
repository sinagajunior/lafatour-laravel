<?php

namespace App\Filament\Resources\CompanySettings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class CompanySettingsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('company_name')
                    ->label('Company Name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('motto')
                    ->label('Company Motto / Tagline')
                    ->helperText('A short phrase that describes your company (e.g., "Umroh & Haji Specialist")')
                    ->maxLength(255),
                TextInput::make('email')
                    ->label('Email Address')
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('phone')
                    ->label('Phone Number')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Textarea::make('address')
                    ->label('Office Address')
                    ->required()
                    ->rows(3)
                    ->columnSpanFull(),
                FileUpload::make('logo')
                    ->label('Company Logo')
                    ->image()
                    ->directory('company')
                    ->disk('public')
                    ->maxSize(2048)
                    ->columnSpanFull(),
            ]);
    }
}
