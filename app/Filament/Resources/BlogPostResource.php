<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogPostResource\Pages;
use App\Models\BlogPost;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Concerns\Translatable;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;

class BlogPostResource extends Resource
{
    use Translatable;

    protected static ?string $model = BlogPost::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                TextInput::make('title')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (string $context, $state, callable $set, \Filament\Forms\Get $get, $livewire) {
                                        if ($context !== 'create') return;
                                        
                                        $locale = property_exists($livewire, 'activeLocale') ? $livewire->activeLocale : null;
                                        
                                        if ($locale === 'en' || !$locale) {
                                            $slug = \Illuminate\Support\Str::slug($state);
                                            $originalSlug = $slug;
                                            $count = 2;
                                            while (\App\Models\BlogPost::where('slug', $slug)->exists()) {
                                                $slug = $originalSlug . '-' . $count;
                                                $count++;
                                            }
                                            $set('slug', $slug);
                                        }
                                    }),
                                TextInput::make('slug')
                                    ->required()
                                    ->unique(BlogPost::class, 'slug', ignoreRecord: true),
                                RichEditor::make('content')
                                    ->required()
                                    ->columnSpanFull(),
                            ]),
                    ])->columnSpan(['lg' => 2]),
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                Select::make('author_id')
                                    ->relationship('author', 'name')
                                    ->required()
                                    ->default(auth()->id()),
                                Select::make('status')
                                    ->options([
                                        'draft' => 'Draft',
                                        'published' => 'Published',
                                    ])
                                    ->default('draft')
                                    ->required(),
                                DateTimePicker::make('published_at'),
                                SpatieMediaLibraryFileUpload::make('cover_image')
                                    ->collection('blog_covers')
                                    ->image(),
                            ]),
                    ])->columnSpan(['lg' => 1]),
                 Forms\Components\Group::make()
                                    ->schema([
                                        Forms\Components\Section::make()
                                        ->schema([
                                            TextInput::make('seo_title')
                                                ->required(),
                                            TextInput::make('seo_description'),
                                            TextInput::make('seo_keywords'),
                                            TextInput::make('canonical_url'),
                                            TextInput::make('og_title'),
                                            TextInput::make('og_description'),
                                            SpatieMediaLibraryFileUpload::make('og_image')
                                                ->collection('og_image')
                                                ->image()
                                                ->columnSpanFull(),
                                            TextInput::make('twitter_title'),
                                            TextInput::make('twitter_description'),
                                            SpatieMediaLibraryFileUpload::make('twitter_image')
                                                ->collection('twitter_image')
                                                ->image()
                                                ->columnSpanFull(),
                                            TextInput::make('robots'),
                                        ]),
                                    ])->columnSpan(['lg' => 1]),                    
            ])->columns(['default' => 3]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('cover_image')
                    ->collection('blog_covers'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'published' => 'success',
                        'draft' => 'gray',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlogPosts::route('/'),
            'create' => Pages\CreateBlogPost::route('/create'),
            'edit' => Pages\EditBlogPost::route('/{record}/edit'),
        ];
    }
}
