<?php

namespace App\Filament\HR\Widgets;

use App\Filament\HR\Resources\ApplicationResource;
use App\Models\Application;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentApplicationsTable extends BaseWidget
{
    protected static bool $isLazy = false;

    protected int | string | array $columnSpan = 1;

    protected static ?string $heading = 'Recent Applications';

    public static function canView(): bool
    {
        return auth()->user()?->hasPortalRole(['admin', 'hr']) ?? false;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Application::query()->latest()->limit(5))
            ->recordUrl(fn (Application $record): string => ApplicationResource::getUrl('edit', ['record' => $record]))
            ->paginated(false)
            ->columns([
                Tables\Columns\TextColumn::make('applicant_name')
                    ->label('Applicant')
                    ->searchable()
                    ->weight('medium'),
                Tables\Columns\TextColumn::make('jobPosting.title')
                    ->label('Role')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'warning',
                        'screening' => 'info',
                        'interview' => 'primary',
                        'offer' => 'success',
                        'hired' => 'success',
                        'rejected' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Applied')
                    ->since(),
            ]);
    }
}
