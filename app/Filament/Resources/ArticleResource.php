<?php

namespace App\Filament\Resources;

use App\Enums\ArticleStatus;
use App\Filament\Resources\ArticleResource\Pages\CreateArticle;
use App\Filament\Resources\ArticleResource\Pages\EditArticle;
use App\Filament\Resources\ArticleResource\Pages\ListArticles;
use App\Models\Article;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Str;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-s-newspaper';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->columns(2)
                    ->schema([
                        TextInput::make('slug')
                            ->disabled()
                            ->required()
                            ->unique(Article::class, 'slug', fn ($record) => $record),

                        TextInput::make('title')
                            ->required()
                            ->reactive()
                            ->maxLength(100)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),

                        TextInput::make('excerpt')
                            ->required()
                            ->maxLength(255),

                        Select::make('tags')
                            ->multiple()
                            ->relationship('tags', 'name'),

                        MarkdownEditor::make('content')
                            ->columnSpan('full'),

                        Select::make('status')
                            ->options(ArticleStatus::options())
                            ->required()
                            ->enum(ArticleStatus::class),

                        DateTimePicker::make('published_at'),

                        Placeholder::make('created_at')
                            ->label('Created Date')
                            ->content(fn (?Article $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                        Placeholder::make('updated_at')
                            ->label('Last Modified Date')
                            ->content(fn (?Article $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
                    ]),
            ]);
    }

    /** @throws \Exception */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('slug'),
            ])
            ->filters([
                Filter::make('is_published')
                    ->query(fn (Builder $query) => $query->whereNotNull('published_at')),

                SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'reviewing' => 'Reviewing',
                        'published' => 'Published',
                    ]),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                CreateAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListArticles::route('/'),
            'create' => CreateArticle::route('/create'),
            'edit' => EditArticle::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return [
            'slug',
            'title',
        ];
    }
}
