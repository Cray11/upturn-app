<?php
namespace App\Filament\HR\Resources;

use App\Filament\HR\Resources\ApplicationResource\Pages;
use App\Models\Application;
use App\Services\HR\ApplicationService;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ApplicationResource extends Resource
{
    protected static ?string $model = Application::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-check';
    protected static ?string $navigationLabel = 'Applications';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('job_posting_id')
                ->relationship('jobPosting', 'title')
                ->required()
                ->native(false)
                ->label('Job Position'),
            TextInput::make('applicant_name')
                ->required()
                ->maxLength(255)
                ->label('Full Name'),
            TextInput::make('email')
                ->email()
                ->required(),
            TextInput::make('contact_no')
                ->required()
                ->label('Contact Number'),
            TextInput::make('address')
                ->required()
                ->columnSpanFull(),
            TextInput::make('transportation_mode')
                ->required()
                ->label('Mode of Transportation to Valenzuela'),
            TextInput::make('best_time_to_contact')
                ->required(),
            Select::make('status')
                ->options([
                    'new' => 'New',
                    'screening' => 'Screening',
                    'interview' => 'Interview',
                    'offer' => 'Offer',
                    'hired' => 'Hired',
                    'rejected' => 'Rejected',
                ])
                ->required()
                ->native(false)
                ->default('new'),
            Textarea::make('professional_summary')
                ->required()
                ->rows(4)
                ->columnSpanFull(),
            Textarea::make('educational_background')
                ->required()
                ->rows(4)
                ->columnSpanFull(),
            TextInput::make('recent_company')
                ->label('Most Recent Company')
                ->nullable(),
            TextInput::make('recent_position')
                ->label('Most Recent Position')
                ->nullable(),
            Textarea::make('opportunity_reason')
                ->required()
                ->rows(3)
                ->columnSpanFull(),
            FileUpload::make('resume_path')
                ->label('Resume (PDF)')
                ->disk('private')
                ->directory('resumes')
                ->acceptedFileTypes(['application/pdf'])
                ->nullable(),
            Textarea::make('remarks')
                ->rows(3)
                ->nullable()
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('applicant_name')->searchable()->sortable()->label('Applicant'),
                TextColumn::make('jobPosting.title')->label('Position')->sortable(),
                TextColumn::make('contact_no')->label('Contact'),
                TextColumn::make('best_time_to_contact')->label('Best Time'),
                TextColumn::make('status')->badge()
                    ->color(fn ($state) => match ($state) {
                        'new' => 'info',
                        'screening' => 'warning',
                        'interview' => 'warning',
                        'offer' => 'success',
                        'hired' => 'success',
                        'rejected' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('created_at')->dateTime()->sortable()->label('Applied'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'new' => 'New',
                        'screening' => 'Screening',
                        'interview' => 'Interview',
                        'offer' => 'Offer',
                        'hired' => 'Hired',
                        'rejected' => 'Rejected',
                    ]),
                SelectFilter::make('jobPosting')
                    ->relationship('jobPosting', 'title')
                    ->label('Position'),
            ])
            ->actions([
                Action::make('resume')
                    ->label('View Resume')
                    ->visible(fn (Application $record): bool => filled($record->resume_path))
                    ->url(fn (Application $record): string => app(ApplicationService::class)->resumeUrl($record))
                    ->openUrlInNewTab(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function canAccess(): bool
    {
        return auth()->user()?->hasPortalRole(['admin', 'hr']) ?? false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListApplications::route('/'),
            'create' => Pages\CreateApplication::route('/create'),
            'edit' => Pages\EditApplication::route('/{record}/edit'),
        ];
    }
}
