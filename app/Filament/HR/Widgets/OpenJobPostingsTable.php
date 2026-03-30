<?php

namespace App\Filament\HR\Widgets;

use App\Filament\HR\Resources\JobPostingResource;
use App\Models\JobPosting;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class OpenJobPostingsTable extends BaseWidget
{
    protected static bool $isLazy = false;

    protected int | string | array $columnSpan = 1;

    protected static ?string $heading = 'Open Job Postings';

    public static function canView(): bool
    {
        return auth()->user()?->hasPortalRole(['admin', 'hr']) ?? false;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                JobPosting::open()
                    ->withCount('applications')
                    ->latest()
                    ->limit(5)
            )
            ->recordUrl(fn (JobPosting $record): string => JobPostingResource::getUrl('edit', ['record' => $record]))
            ->paginated(false)
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->weight('medium'),
                Tables\Columns\TextColumn::make('department')
                    ->placeholder('General'),
                Tables\Columns\TextColumn::make('applications_count')
                    ->label('Applicants')
                    ->badge()
                    ->color('info'),
                Tables\Columns\TextColumn::make('deadline')
                    ->date('M j, Y')
                    ->placeholder('No deadline'),
            ]);
    }
}
