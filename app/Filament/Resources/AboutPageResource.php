<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutPageResource\Pages;
use App\Filament\Resources\AboutPageResource\RelationManagers;
use App\Models\AboutPage;
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
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class AboutPageResource extends Resource
{
    use Translatable;

    protected static ?string $model = AboutPage::class;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';
    
    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'About Us Page';
    
    protected static ?string $slug = 'about-page';

    public static function getTranslatableLocales(): array
    {
        return ['ar', 'en'];
    }

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
                Tabs::make('About Us Page Content')
                    ->tabs([
                        Tabs\Tab::make('Hero & Main Content')
                            ->icon('heroicon-m-presentation-chart-bar')
                            ->schema([
                                TextInput::make('hero_title')
                                    ->required(),
                                RichEditor::make('content')
                                    ->required()
                                    ->columnSpanFull(),
                                SpatieMediaLibraryFileUpload::make('office_image')
                                    ->collection('about_office')
                                    ->image()
                                    ->columnSpanFull(),
                            ]),
                        
                        Tabs\Tab::make('Vision Tab')
                            ->icon('heroicon-m-eye')
                            ->schema([
                                TextInput::make('vision_title')
                                    ->required(),
                                RichEditor::make('vision_content')
                                    ->required()
                                    ->columnSpanFull(),
                            ]),

                        Tabs\Tab::make('Clients Tab')
                            ->icon('heroicon-m-users')
                            ->schema([
                                TextInput::make('clients_title')
                                    ->required(),
                                RichEditor::make('clients_content')
                                    ->required()
                                    ->columnSpanFull(),
                            ]),

                        Tabs\Tab::make('Goal Tab')
                            ->icon('heroicon-m-light-bulb')
                            ->schema([
                                TextInput::make('goals_title')
                                    ->required(),
                                RichEditor::make('goals_content')
                                    ->required()
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
                TextColumn::make('hero_title')
                    ->limit(50)
                    ->searchable(),
                IconColumn::make('is_active')
                    ->boolean(),
                TextColumn::make('updated_at')
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
            'index' => Pages\ListAboutPages::route('/'),
            'create' => Pages\CreateAboutPage::route('/create'),
            'edit' => Pages\EditAboutPage::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
