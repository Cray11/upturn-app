<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\EngagementResource\Pages;
use App\Models\Engagement;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class EngagementResource extends Resource
{
    protected static ?string $model = Engagement::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Content Management';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('section')
                ->options(Engagement::sectionOptions())
                ->required()
                ->native(false),
            TextInput::make('label')
                ->nullable()
                ->maxLength(255)
                ->helperText('Examples: Tax Compliance, October 2023, Anniversary Gala'),
            TextInput::make('title')
                ->required()
                ->maxLength(255),
            Textarea::make('description')
                ->required()
                ->rows(6)
                ->columnSpanFull(),
            FileUpload::make('images')
                ->label('Image Gallery')
                ->multiple()
                ->reorderable()
                ->appendFiles()
                ->image()
                ->disk('public')
                ->visibility('public')
                ->directory('engagements')
                ->panelLayout('grid')
                ->openable()
                ->downloadable()
                ->columnSpanFull(),
            TextInput::make('sort_order')
                ->numeric()
                ->default(0),
            Toggle::make('is_published')
                ->label('Published')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('section')
                    ->label('Section')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => Engagement::sectionOptions()[$state] ?? $state)
                    ->sortable(),
                TextColumn::make('label')
                    ->limit(24)
                    ->searchable(),
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(40),
                TextColumn::make('images_count')
                    ->label('Images')
                    ->state(fn (Engagement $record): int => count($record->images ?? [])),
                IconColumn::make('is_published')
                    ->label('Published')
                    ->boolean(),
                TextColumn::make('sort_order')
                    ->sortable()
                    ->label('Order'),
                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->since()
                    ->sortable(),
            ])
            ->defaultSort('section')
            ->filters([
                SelectFilter::make('section')
                    ->options(Engagement::sectionOptions()),
                TernaryFilter::make('is_published')
                    ->label('Published'),
            ])
            ->actions([
                ViewAction::make()
                    ->modalHeading(fn (Engagement $record): string => $record->title)
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Close')
                    ->modalWidth('5xl')
                    ->modalContent(fn (Engagement $record) => view('filament.admin.resources.engagements.preview', [
                        'record' => $record,
                    ])),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function canAccess(): bool
    {
        return auth()->user()?->hasPortalRole(['admin', 'staff']) ?? false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEngagements::route('/'),
            'create' => Pages\CreateEngagement::route('/create'),
            'edit' => Pages\EditEngagement::route('/{record}/edit'),
        ];
    }
}
