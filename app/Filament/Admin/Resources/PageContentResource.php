<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PageContentResource\Pages;
use App\Models\PageContent;
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

class PageContentResource extends Resource
{
    protected static ?string $model = PageContent::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';

    protected static ?string $navigationGroup = 'Content Management';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('page')
                ->options(PageContent::pageOptions())
                ->required()
                ->native(false),
            Select::make('section')
                ->options(PageContent::sectionOptions())
                ->required()
                ->native(false),
            TextInput::make('label')
                ->nullable()
                ->maxLength(255),
            TextInput::make('title')
                ->nullable()
                ->maxLength(255),
            Textarea::make('description')
                ->nullable()
                ->rows(6)
                ->columnSpanFull(),
            FileUpload::make('image')
                ->image()
                ->disk('public')
                ->visibility('public')
                ->directory('page-content')
                ->openable()
                ->downloadable()
                ->columnSpanFull(),
            TextInput::make('primary_button_label')
                ->nullable()
                ->maxLength(255),
            TextInput::make('primary_button_url')
                ->nullable()
                ->maxLength(255)
                ->placeholder('/contact'),
            TextInput::make('secondary_button_label')
                ->nullable()
                ->maxLength(255),
            TextInput::make('secondary_button_url')
                ->nullable()
                ->maxLength(255)
                ->placeholder('/services'),
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
                TextColumn::make('page')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => PageContent::pageOptions()[$state] ?? $state)
                    ->sortable(),
                TextColumn::make('section')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => PageContent::sectionOptions()[$state] ?? $state)
                    ->sortable(),
                TextColumn::make('label')
                    ->limit(24),
                TextColumn::make('title')
                    ->limit(40)
                    ->searchable(),
                IconColumn::make('is_published')
                    ->label('Published')
                    ->boolean(),
                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->since()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('page')
                    ->options(PageContent::pageOptions()),
                SelectFilter::make('section')
                    ->options(PageContent::sectionOptions()),
                TernaryFilter::make('is_published')
                    ->label('Published'),
            ])
            ->actions([
                ViewAction::make()
                    ->modalHeading(fn (PageContent $record): string => ($record->title ?: 'Page Content').' Preview')
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Close')
                    ->modalWidth('4xl')
                    ->modalContent(fn (PageContent $record) => view('filament.admin.resources.page-contents.preview', [
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
            'index' => Pages\ListPageContents::route('/'),
            'create' => Pages\CreatePageContent::route('/create'),
            'edit' => Pages\EditPageContent::route('/{record}/edit'),
        ];
    }
}
