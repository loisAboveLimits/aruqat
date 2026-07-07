<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteSettingResource\Pages;
use App\Filament\Resources\SiteSettingResource\RelationManagers;
use App\Models\SiteSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Resources\Concerns\Translatable;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class SiteSettingResource extends Resource
{
    use Translatable;

    protected static ?string $model = SiteSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    
    protected static ?int $navigationSort = 9;

    protected static ?string $navigationLabel = 'Site Settings';
    
    protected static ?string $slug = 'site-settings';

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
                Tabs::make('Global Settings')
                    ->tabs([
                        Tabs\Tab::make('General Setting')
                            ->icon('heroicon-m-computer-desktop')
                            ->schema([
                                TextInput::make('site_name')
                                    ->required(),
                                SpatieMediaLibraryFileUpload::make('favicon')
                                    ->collection('favicon')
                                    ->image(),
                                SpatieMediaLibraryFileUpload::make('logo')
                                    ->collection('logo')
                                    ->image(),
                                SpatieMediaLibraryFileUpload::make('footer_logo')
                                    ->collection('footer_logo')
                                    ->image(),
                            ]),
                        
                        Tabs\Tab::make('Contact Info')
                            ->icon('heroicon-m-phone')
                            ->schema([
                                TextInput::make('address')
                                    ->required(),
                                TextInput::make('email')
                                    ->email()
                                    ->required(),
                                TextInput::make('phone')
                                    ->tel()
                                    ->required(),
                            ]),

                        Tabs\Tab::make('Social Links')
                            ->icon('heroicon-m-share')
                            ->schema([
                                TextInput::make('facebook_url')
                                    ->url(),
                                TextInput::make('x_url')
                                    ->url(),
                                TextInput::make('linkedin_url')
                                    ->url(),
                                TextInput::make('instagram_url')
                                    ->url(),
                            ]),

                        Tabs\Tab::make('Footer')
                            ->icon('heroicon-m-document-text')
                            ->schema([
                                Textarea::make('footer_description')
                                    ->rows(3),
                                Repeater::make('footer_nav')
                                    ->schema([
                                        TextInput::make('label')
                                            ->required(),
                                        TextInput::make('url')
                                            ->required(),
                                    ])
                                    ->columnSpanFull(),
                                TextInput::make('copyright_text')
                                    ->label('Main Copyright Text'),
                            ]),

                        Tabs\Tab::make('Pages Settings')
                            ->icon('heroicon-m-photo')
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('about_hero')
                                    ->collection('about_hero')
                                    ->image()
                                    ->label('About Us Hero Background'),
                                SpatieMediaLibraryFileUpload::make('contact_hero')
                                    ->collection('contact_hero')
                                    ->image()
                                    ->label('Contact Us Hero Background'),
                                SpatieMediaLibraryFileUpload::make('services_hero')
                                    ->collection('services_hero')
                                    ->image()
                                    ->label('Services Hero Background'),
                                SpatieMediaLibraryFileUpload::make('blog_hero')
                                    ->collection('blog_hero')
                                    ->image()
                                    ->label('Blog & Articles Hero Background'),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('site_name')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListSiteSettings::route('/'),
            'create' => Pages\CreateSiteSetting::route('/create'),
            'edit' => Pages\EditSiteSetting::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return SiteSetting::count() === 0;
    }
}
