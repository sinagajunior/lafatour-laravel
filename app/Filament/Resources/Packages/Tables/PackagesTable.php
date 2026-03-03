<?php

namespace App\Filament\Resources\Packages\Tables;

use App\Exports\PackagesExport;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PackagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Package Name')
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),
                TextColumn::make('slug')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('packageType.name')
                    ->label('Package Type')
                    ->badge()
                    ->default('—'),
                TextColumn::make('price')
                    ->label('Price')
                    ->money('IDR')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                TextColumn::make('early_bird_price')
                    ->label('Early Bird')
                    ->toggleable()
                    ->formatStateUsing(fn ($state) => $state ? 'Rp ' . number_format($state, 0, ',', '.') : '-'),
                TextColumn::make('duration')
                    ->toggleable(),
                TextColumn::make('departure_date')
                    ->label('Departure')
                    ->date('M j, Y')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('quota')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('seats_available')
                    ->label('Available Seats')
                    ->numeric()
                    ->sortable()
                    ->formatStateUsing(fn ($state) => $state ?? '∞'),
                TextColumn::make('hotel_mekkah')
                    ->label('Mekkah Hotel')
                    ->searchable()
                    ->limit(20)
                    ->toggleable(),
                TextColumn::make('hotel_madinah')
                    ->label('Madinah Hotel')
                    ->searchable()
                    ->limit(20)
                    ->toggleable(),
                TextColumn::make('airline')
                    ->searchable()
                    ->toggleable(),
                IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean()
                    ->toggleable(),
                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('M j, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->reorderRecords('created_at', 'desc')
            ->paginated([10, 25, 50, 100])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->headerActions([
                Action::make('export')
                    ->label('Export Excel')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('primary')
                    ->action(function (): BinaryFileResponse {
                        return Excel::download(new PackagesExport(), 'packages-' . date('Y-m-d-His') . '.xlsx');
                    }),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                    Action::make('exportSelected')
                        ->label('Export Selected')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(function ($records): BinaryFileResponse {
                            $ids = $records->pluck('id')->toArray();
                            $export = new PackagesExport();
                            $export->onlyIds($ids);
                            return Excel::download($export, 'packages-selected-' . date('Y-m-d-His') . '.xlsx');
                        }),
                ]),
            ]);
    }
}
