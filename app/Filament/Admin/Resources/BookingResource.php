<?php
namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\BookingResource\Pages;
use App\Models\Booking;
use Illuminate\Support\Str;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationGroup = 'Booking Management';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('space_id')
                ->relationship('space', 'name')
                ->required()
                ->native(false)
                ->label('Space'),
            Select::make('user_id')
                ->relationship('user', 'name')
                ->nullable()
                ->native(false)
                ->label('Client (optional)'),
            TextInput::make('reference_no')
                ->default(fn () => 'UPT-' . strtoupper(Str::random(8)))
                ->required()
                ->unique(ignoreRecord: true)
                ->label('Reference No.'),
            DatePicker::make('booking_date')
                ->required()
                ->native(false),
            TimePicker::make('start_time')
                ->required(),
            TimePicker::make('end_time')
                ->required(),
            TextInput::make('duration_hours')
                ->numeric()
                ->required()
                ->default(1)
                ->label('Duration (hours)'),
            TextInput::make('total_amount')
                ->numeric()
                ->prefix('₱')
                ->required()
                ->default(0),
            Select::make('status')
                ->options([
                    'pending'   => 'Pending',
                    'confirmed' => 'Confirmed',
                    'cancelled' => 'Cancelled',
                    'completed' => 'Completed',
                ])
                ->required()
                ->native(false)
                ->default('confirmed'),
            Textarea::make('notes')
                ->nullable()
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('reference_no')->searchable()->sortable()->label('Ref #'),
                TextColumn::make('space.name')->sortable()->label('Space'),
                TextColumn::make('user.name')->sortable()->label('Client')->default('Walk-in'),
                TextColumn::make('booking_date')->date()->sortable(),
                TextColumn::make('start_time')->label('Start'),
                TextColumn::make('end_time')->label('End'),
                TextColumn::make('total_amount')->money('PHP')->sortable(),
                TextColumn::make('status')->badge()
                    ->color(fn ($state) => match ($state) {
                        'confirmed' => 'success',
                        'pending'   => 'warning',
                        'cancelled' => 'danger',
                        'completed' => 'info',
                        default     => 'gray',
                    }),
            ])
            ->defaultSort('booking_date', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending'   => 'Pending',
                        'confirmed' => 'Confirmed',
                        'cancelled' => 'Cancelled',
                        'completed' => 'Completed',
                    ]),
                SelectFilter::make('space')
                    ->relationship('space', 'name'),
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
            'index'  => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit'   => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
