<?php
namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\InquiryResource\Pages;
use App\Models\Inquiry;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;

class InquiryResource extends Resource
{
    protected static ?string $model = Inquiry::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'Client Management';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->required()
                ->maxLength(255),
            TextInput::make('email')
                ->email()
                ->required(),
            TextInput::make('contact_no')
                ->nullable(),
            TextInput::make('business_name')
                ->nullable(),
            Select::make('service_interest')
                ->options([
                    'Tax Compliance'        => 'Tax Compliance',
                    'Bookkeeping'           => 'Bookkeeping',
                    'Business Registration' => 'Business Registration',
                    'Audit Services'        => 'Audit Services',
                    'AFS & ITR'             => 'AFS & ITR',
                    'Co-Working Space'      => 'Co-Working Space',
                    'Virtual Office'        => 'Virtual Office',
                    'Meeting Room'          => 'Meeting Room',
                ])
                ->nullable()
                ->native(false),
            Select::make('source')
                ->options([
                    'website'  => 'Website',
                    'walk_in'  => 'Walk-in',
                    'referral' => 'Referral',
                    'social'   => 'Social Media',
                ])
                ->required()
                ->native(false)
                ->default('website'),
            Select::make('status')
                ->options([
                    'new'         => 'New',
                    'in_progress' => 'In Progress',
                    'resolved'    => 'Resolved',
                    'closed'      => 'Closed',
                ])
                ->required()
                ->native(false)
                ->default('new'),
            Select::make('assigned_to')
                ->relationship('assignedUser', 'name')
                ->nullable()
                ->native(false)
                ->label('Assigned To'),
            Textarea::make('message')
                ->required()
                ->rows(4)
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('contact_no')->label('Contact'),
                TextColumn::make('service_interest')->label('Service')->limit(30),
                TextColumn::make('source')->badge()->color('info'),
                TextColumn::make('status')->badge()
                    ->color(fn ($state) => match ($state) {
                        'new'         => 'warning',
                        'in_progress' => 'info',
                        'resolved'    => 'success',
                        'closed'      => 'gray',
                        default       => 'gray',
                    }),
                TextColumn::make('assignedUser.name')->label('Assigned To')->default('Unassigned'),
                TextColumn::make('created_at')->dateTime()->sortable()->label('Received'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'new'         => 'New',
                        'in_progress' => 'In Progress',
                        'resolved'    => 'Resolved',
                        'closed'      => 'Closed',
                    ]),
                SelectFilter::make('source')
                    ->options([
                        'website'  => 'Website',
                        'walk_in'  => 'Walk-in',
                        'referral' => 'Referral',
                        'social'   => 'Social Media',
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
            'index'  => Pages\ListInquiries::route('/'),
            'create' => Pages\CreateInquiry::route('/create'),
            'edit'   => Pages\EditInquiry::route('/{record}/edit'),
        ];
    }
}
