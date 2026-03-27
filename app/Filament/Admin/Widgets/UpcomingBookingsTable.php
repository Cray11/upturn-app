<?php

namespace App\Filament\Admin\Widgets;

use App\Filament\Admin\Resources\BookingResource;
use App\Models\Booking;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class UpcomingBookingsTable extends BaseWidget
{
    protected static bool $isLazy = false;

    protected int | string | array $columnSpan = 1;

    protected static ?string $heading = 'Upcoming Bookings';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Booking::query()
                    ->whereDate('booking_date', '>=', today())
                    ->orderBy('booking_date')
                    ->orderBy('start_time')
                    ->limit(5)
            )
            ->recordUrl(fn (Booking $record): string => BookingResource::getUrl('edit', ['record' => $record]))
            ->paginated(false)
            ->columns([
                Tables\Columns\TextColumn::make('reference_no')
                    ->label('Ref #')
                    ->weight('medium'),
                Tables\Columns\TextColumn::make('space.name')
                    ->label('Space'),
                Tables\Columns\TextColumn::make('booking_date')
                    ->date('M j, Y'),
                Tables\Columns\TextColumn::make('start_time')
                    ->label('Start'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'confirmed' => 'success',
                        'pending' => 'warning',
                        'cancelled' => 'danger',
                        'completed' => 'info',
                        default => 'gray',
                    }),
            ]);
    }
}
