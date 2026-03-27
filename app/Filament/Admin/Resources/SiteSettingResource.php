<?php
namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SiteSettingResource\Pages;
use App\Models\SiteSetting;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('key')
                ->required()
                ->maxLength(255)
                ->unique(ignoreRecord: true),
            Select::make('group')
                ->options([
                    'general' => 'General',
                    'contact' => 'Contact',
                    'social' => 'Social',
                    'homepage' => 'Homepage',
                ])
                ->required()
                ->native(false)
                ->default('general'),
            Select::make('type')
                ->options([
                    'text' => 'Text',
                    'image' => 'Image',
                    'boolean' => 'Boolean',
                    'json' => 'JSON',
                ])
                ->required()
                ->native(false)
                ->default('text'),
            Textarea::make('value')
                ->rows(5)
                ->nullable()
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('key')->searchable()->sortable(),
                TextColumn::make('group')->badge()->sortable(),
                TextColumn::make('type')->badge(),
                TextColumn::make('value')->limit(50)->wrap(),
                TextColumn::make('updated_at')->since()->label('Updated'),
            ])
            ->filters([
                SelectFilter::make('group')
                    ->options([
                        'general' => 'General',
                        'contact' => 'Contact',
                        'social' => 'Social',
                        'homepage' => 'Homepage',
                    ]),
            ])
            ->defaultSort('key')
            ->actions([EditAction::make(), DeleteAction::make()])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function canAccess(): bool
    {
        return auth()->user()?->hasPortalRole(['admin', 'staff']) ?? false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSiteSettings::route('/'),
            'create' => Pages\CreateSiteSetting::route('/create'),
            'edit' => Pages\EditSiteSetting::route('/{record}/edit'),
        ];
    }
}
