<?php
namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SpaceResource\Pages;
use App\Models\Space;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;

class SpaceResource extends Resource
{
    protected static ?string $model = Space::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationGroup = 'Booking Management';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->required()
                ->maxLength(255),
            Select::make('type')
                ->options([
                    'coworking'      => 'Co-Working Space',
                    'virtual_office' => 'Virtual Office',
                    'meeting_room'   => 'Meeting Room',
                ])
                ->required()
                ->native(false),
            TextInput::make('capacity')
                ->numeric()
                ->required()
                ->default(1),
            TextInput::make('price_per_hour')
                ->numeric()
                ->prefix('₱')
                ->nullable(),
            TextInput::make('price_per_day')
                ->numeric()
                ->prefix('₱')
                ->nullable(),
            Toggle::make('is_available')
                ->default(true)
                ->label('Available'),
            Textarea::make('description')
                ->rows(3)
                ->nullable()
                ->columnSpanFull(),
            FileUpload::make('thumbnail')
                ->image()
                ->directory('spaces')
                ->nullable()
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail'),
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('type')->badge()
                    ->color(fn ($state) => match ($state) {
                        'coworking'      => 'success',
                        'virtual_office' => 'warning',
                        'meeting_room'   => 'info',
                        default          => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'coworking'      => 'Co-Working',
                        'virtual_office' => 'Virtual Office',
                        'meeting_room'   => 'Meeting Room',
                        default          => $state,
                    }),
                TextColumn::make('capacity')->sortable(),
                TextColumn::make('price_per_hour')->money('PHP')->label('Per Hour'),
                TextColumn::make('price_per_day')->money('PHP')->label('Per Day'),
                ToggleColumn::make('is_available')->label('Available'),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options([
                        'coworking'      => 'Co-Working Space',
                        'virtual_office' => 'Virtual Office',
                        'meeting_room'   => 'Meeting Room',
                    ]),
            ])
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
            'index'  => Pages\ListSpaces::route('/'),
            'create' => Pages\CreateSpace::route('/create'),
            'edit'   => Pages\EditSpace::route('/{record}/edit'),
        ];
    }
}
