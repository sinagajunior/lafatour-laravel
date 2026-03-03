<?php

namespace App\Filament\Resources\Testimonials\Tables;

use App\Exports\TestimonialsExport;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class TestimonialsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer_name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable()
                    ->weight('medium')
                    ->limit(30),
                TextColumn::make('package.name')
                    ->label('Package')
                    ->limit(25)
                    ->toggleable(),
                TextColumn::make('rating')
                    ->label('Rating')
                    ->numeric()
                    ->sortable()
                    ->formatStateUsing(fn ($state) => '⭐' . $state),
                TextColumn::make('review')
                    ->label('Review')
                    ->limit(50)
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('travel_date')
                    ->label('Travel Date')
                    ->date('M j, Y')
                    ->sortable()
                    ->toggleable(),
                IconColumn::make('is_approved')
                    ->label('Approved')
                    ->boolean()
                    ->toggleable(),
                IconColumn::make('is_featured')
                    ->label('Featured')
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
                SelectFilter::make('rating')
                    ->label('Rating')
                    ->options([
                        5 => '⭐⭐⭐⭐⭐ (5)',
                        4 => '⭐⭐⭐⭐ (4)',
                        3 => '⭐⭐⭐ (3)',
                        2 => '⭐⭐ (2)',
                        1 => '⭐ (1)',
                    ]),
                TernaryFilter::make('is_approved')
                    ->label('Approved')
                    ->default(true),
                TernaryFilter::make('is_featured')
                    ->label('Featured'),
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
                        return Excel::download(new TestimonialsExport(), 'testimonials-' . date('Y-m-d-His') . '.xlsx');
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
                            $export = new TestimonialsExport();
                            $export->onlyIds($ids);
                            return Excel::download($export, 'testimonials-selected-' . date('Y-m-d-His') . '.xlsx');
                        }),
                ]),
            ]);
    }
}

