<?php

namespace App\Filament\Admin\Widgets;

use App\Filament\Admin\Resources\InquiryResource;
use App\Models\Inquiry;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentInquiriesTable extends BaseWidget
{
    protected static bool $isLazy = false;

    protected int | string | array $columnSpan = 1;

    protected static ?string $heading = 'Recent Inquiries';

    public function table(Table $table): Table
    {
        return $table
            ->query(Inquiry::query()->latest()->limit(5))
            ->recordUrl(fn (Inquiry $record): string => InquiryResource::getUrl('edit', ['record' => $record]))
            ->paginated(false)
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->weight('medium'),
                Tables\Columns\TextColumn::make('service_interest')
                    ->label('Service')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('source')
                    ->badge()
                    ->color('info'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'warning',
                        'in_progress' => 'info',
                        'resolved' => 'success',
                        'closed' => 'gray',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Received')
                    ->since(),
            ]);
    }
}
