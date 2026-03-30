<?php
namespace App\Filament\HR\Resources;

use App\Filament\HR\Resources\JobPostingResource\Pages;
use App\Models\JobPosting;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;

class JobPostingResource extends Resource
{
    protected static ?string $model = JobPosting::class;
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationLabel = 'Job Postings';
    protected static ?string $navigationGroup = 'Human Resources';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('title')
                ->required()
                ->maxLength(255)
                ->columnSpanFull(),
            TextInput::make('department')
                ->nullable(),
            TextInput::make('location')
                ->default('Valenzuela City'),
            Select::make('employment_type')
                ->options([
                    'full_time'   => 'Full Time',
                    'part_time'   => 'Part Time',
                    'contractual' => 'Contractual',
                    'internship'  => 'Internship',
                ])
                ->required()
                ->native(false)
                ->default('full_time'),
            Select::make('status')
                ->options([
                    'draft'  => 'Draft',
                    'open'   => 'Open',
                    'closed' => 'Closed',
                ])
                ->required()
                ->native(false)
                ->default('draft'),
            DatePicker::make('deadline')
                ->nullable()
                ->native(false),
            RichEditor::make('description')
                ->required()
                ->columnSpanFull(),
            RichEditor::make('requirements')
                ->nullable()
                ->columnSpanFull(),
        ]);
    }

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        return $data;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable()->sortable(),
                TextColumn::make('department')->sortable(),
                TextColumn::make('employment_type')->badge()->label('Type')
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'full_time'   => 'Full Time',
                        'part_time'   => 'Part Time',
                        'contractual' => 'Contractual',
                        'internship'  => 'Internship',
                        default       => $state,
                    }),
                TextColumn::make('status')->badge()
                    ->color(fn ($state) => match ($state) {
                        'open'   => 'success',
                        'draft'  => 'warning',
                        'closed' => 'danger',
                        default  => 'gray',
                    }),
                TextColumn::make('deadline')->date()->sortable(),
                TextColumn::make('applications_count')
                    ->counts('applications')
                    ->label('Applications'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options(['draft' => 'Draft', 'open' => 'Open', 'closed' => 'Closed']),
                SelectFilter::make('employment_type')
                    ->options([
                        'full_time'   => 'Full Time',
                        'part_time'   => 'Part Time',
                        'contractual' => 'Contractual',
                        'internship'  => 'Internship',
                    ]),
            ])
            ->actions([EditAction::make(), DeleteAction::make()])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function canAccess(): bool
    {
        return auth()->user()?->hasPortalRole(['admin', 'hr']) ?? false;
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListJobPostings::route('/'),
            'create' => Pages\CreateJobPosting::route('/create'),
            'edit'   => Pages\EditJobPosting::route('/{record}/edit'),
        ];
    }
}
