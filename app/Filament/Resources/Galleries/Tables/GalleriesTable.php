<?php

namespace App\Filament\Resources\Galleries\Tables;

use App\Exports\GalleriesExport;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class GalleriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')
                    ->label('Image')
                    ->square()
                    ->size(80)
                    ->getStateUsing(function ($record) {
                        if (!$record->image_path) {
                            return null;
                        }
                        if (filter_var($record->image_path, FILTER_VALIDATE_URL)) {
                            return $record->image_path;
                        }
                        if (Storage::disk('public')->exists($record->image_path)) {
                            return Storage::disk('public')->url($record->image_path);
                        }
                        return asset('assets/images/placeholder.jpg');
                    }),
                TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable()
                    ->weight('medium')
                    ->limit(30),
                TextColumn::make('category')
                    ->label('Category')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'umroh' => 'info',
                        'haji' => 'success',
                        'activity' => 'warning',
                        'office' => 'gray',
                        'team' => 'primary',
                        default => 'gray',
                    }),
                TextColumn::make('package.name')
                    ->label('Package')
                    ->default('—')
                    ->limit(25),
                IconColumn::make('is_video')
                    ->label('Video')
                    ->boolean()
                    ->trueIcon('heroicon-o-video-camera')
                    ->falseIcon('heroicon-o-photo')
                    ->trueColor('warning')
                    ->toggleable(isToggledHiddenByDefault: true),
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
            ->paginated([10, 25, 50, 100])
            ->filters([
                SelectFilter::make('category')
                    ->label('Category')
                    ->options([
                        'umroh' => 'Umroh',
                        'haji' => 'Haji',
                        'activity' => 'Activity',
                        'office' => 'Office',
                        'team' => 'Team',
                    ]),
                TernaryFilter::make('is_video')
                    ->label('Video Content'),
                TernaryFilter::make('is_active')
                    ->label('Active')
                    ->default(true),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->headerActions([
                Action::make('export')
                    ->label('Export Excel')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('primary')
                    ->action(function (): BinaryFileResponse {
                        return Excel::download(new GalleriesExport(), 'galleries-' . date('Y-m-d-His') . '.xlsx');
                    }),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    Action::make('exportSelected')
                        ->label('Export Selected')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(function ($records): BinaryFileResponse {
                            $ids = $records->pluck('id')->toArray();
                            $export = new GalleriesExport();
                            $export->onlyIds($ids);
                            return Excel::download($export, 'galleries-selected-' . date('Y-m-d-His') . '.xlsx');
                        }),
                ]),
            ]);
    }
}

