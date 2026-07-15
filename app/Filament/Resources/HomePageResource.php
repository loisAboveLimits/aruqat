<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HomePageResource\Pages;
use App\Models\HomePage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Concerns\Translatable;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Toggle;

class HomePageResource extends Resource
{
    use Translatable;

    protected static ?string $model = HomePage::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';
    
    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Home Page Content';
    
    protected static ?string $slug = 'home-page';

    public static function getNavigationUrl(): string
    {
        $record = static::getModel()::first();
        
        if ($record) {
            return static::getUrl('edit', ['record' => $record]);
        }

        return static::getUrl('index');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Home Page Sections')
                    ->tabs([
                        Tabs\Tab::make('Hero Section')
                            ->icon('heroicon-m-presentation-chart-bar')
                            ->schema([
                                TextInput::make('hero_title')
                                    ->required(),
                                TextInput::make('hero_cta_label'),
                                TextInput::make('hero_cta_url')
                                    ->hint('Absolute or relative URL (e.g. /services)'),
                                TextInput::make('hero_secondary_cta_label'),
                                TextInput::make('hero_secondary_cta_url')
                                    ->hint('Absolute or relative URL (e.g. /contact)'),
                                SpatieMediaLibraryFileUpload::make('hero_background')
                                    ->collection('hero_background')
                                    ->image()
                                    ->columnSpanFull(),
                            ]),
                        
                        Tabs\Tab::make('About Section')
                            ->icon('heroicon-m-information-circle')
                            ->schema([
                                TextInput::make('about_badge')
                                    ->required(),
                                RichEditor::make('about_description')
                                    ->required()
                                    ->columnSpanFull(),
                                TextInput::make('about_cta_label'),
                                TextInput::make('about_cta_url')
                                    ->hint('Absolute or relative URL (e.g. /about-us)'),
                                SpatieMediaLibraryFileUpload::make('about_office')
                                    ->collection('about_office')
                                    ->image()
                                    ->columnSpanFull(),
                            ]),

                        Tabs\Tab::make('Vision Section')
                            ->icon('heroicon-m-light-bulb')
                            ->schema([
                                TextInput::make('goal_badge')
                                    ->required(),
                                TextInput::make('goal_title')
                                    ->required(),
                                TextInput::make('goal_cta_label'),
                                TextInput::make('goal_cta_url')
                                    ->hint('Absolute or relative URL (e.g. /about-us)'),
                                SpatieMediaLibraryFileUpload::make('goal_background')
                                    ->collection('goal_background')
                                    ->image()
                                    ->columnSpanFull(),
                            ]),

                        Tabs\Tab::make('SEO Section')
                            ->icon('iconpark-seo')
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
                    ])
                    ->columnSpanFull(),
                
                Toggle::make('is_active')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('hero_title')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListHomePages::route('/'),
            'edit' => Pages\EditHomePage::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
