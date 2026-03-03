<?php

namespace App\Filament\Resources\Bookings\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class BookingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('booking_number')
                    ->required(),
                TextInput::make('package_id')
                    ->required()
                    ->numeric(),
                TextInput::make('customer_name')
                    ->required(),
                TextInput::make('customer_email')
                    ->email()
                    ->required(),
                TextInput::make('customer_phone')
                    ->tel()
                    ->required(),
                TextInput::make('customer_whatsapp')
                    ->required(),
                Textarea::make('customer_address')
                    ->columnSpanFull(),
                TextInput::make('id_card_number')
                    ->required(),
                DatePicker::make('birth_date'),
                Select::make('gender')
                    ->options(['male' => 'Male', 'female' => 'Female']),
                TextInput::make('emergency_contact_name'),
                TextInput::make('emergency_contact_phone')
                    ->tel(),
                TextInput::make('family_info'),
                Select::make('payment_status')
                    ->options([
            'pending' => 'Pending',
            'down_payment' => 'Down payment',
            'paid' => 'Paid',
            'overdue' => 'Overdue',
        ])
                    ->default('pending')
                    ->required(),
                Select::make('booking_status')
                    ->options([
            'pending' => 'Pending',
            'confirmed' => 'Confirmed',
            'processing' => 'Processing',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
        ])
                    ->default('pending')
                    ->required(),
                TextInput::make('total_amount')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('down_payment')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('down_payment_amount')
                    ->numeric(),
                TextInput::make('remaining_payment')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                DatePicker::make('down_payment_due'),
                DatePicker::make('full_payment_due'),
                DatePicker::make('down_payment_paid_at'),
                DatePicker::make('full_payment_paid_at'),
                TextInput::make('payment_method'),
                TextInput::make('payment_proof'),
                Textarea::make('special_requests')
                    ->columnSpanFull(),
                Textarea::make('admin_notes')
                    ->columnSpanFull(),
                TextInput::make('documents'),
                DateTimePicker::make('confirmed_at'),
                TextInput::make('confirmed_by')
                    ->numeric(),
            ]);
    }
}
