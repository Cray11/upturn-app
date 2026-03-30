<?php
namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PostResource\Pages;
use App\Models\Post;
use Illuminate\Support\Str;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DateTimePicker;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('title')
                ->required()
                ->maxLength(255)
                ->live(onBlur: true)
                ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state)))
                ->columnSpanFull(),
            TextInput::make('slug')
                ->required()
                ->maxLength(255)
                ->unique(ignoreRecord: true)
                ->columnSpanFull(),
            Select::make('status')
                ->options([
                    'draft'     => 'Draft',
                    'published' => 'Published',
                    'archived'  => 'Archived',
                ])
                ->required()
                ->native(false)
                ->default('draft'),
            Select::make('category')
                ->options([
                    'news'         => 'News',
                    'announcement' => 'Announcement',
                    'blog'         => 'Blog',
                    'update'       => 'Update',
                ])
                ->nullable()
                ->native(false),
            FileUpload::make('featured_image')
                ->image()
                ->directory('posts')
                ->nullable()
                ->columnSpanFull(),
            TextInput::make('link_url')
                ->label('Destination Link')
                ->url()
                ->nullable()
                ->placeholder('https://example.com/update')
                ->helperText('Optional link visitors will open when they click this update card.')
                ->columnSpanFull(),
            RichEditor::make('body')
                ->required()
                ->columnSpanFull(),
            DateTimePicker::make('published_at')
                ->label('Publish Date')
                ->nullable()
                ->native(false),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image')->label('Image'),
                TextColumn::make('title')->searchable()->sortable()->limit(50),
                TextColumn::make('author.name')->label('Author')->sortable(),
                TextColumn::make('category')->badge(),
                TextColumn::make('link_url')->label('Link')->limit(35)->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status')->badge()
                    ->color(fn ($state) => match ($state) {
                        'published' => 'success',
                        'draft'     => 'warning',
                        default     => 'gray',
                    }),
                TextColumn::make('published_at')->dateTime()->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'draft'     => 'Draft',
                        'published' => 'Published',
                        'archived'  => 'Archived',
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
            'index'  => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit'   => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
