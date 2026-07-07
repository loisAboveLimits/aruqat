<?php

namespace App\Filament\Resources\AboutPageResource\Pages;

use App\Filament\Resources\AboutPageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Concerns\Translatable;

class ListAboutPages extends ListRecords
{
    use Translatable;

    protected static string $resource = AboutPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }

    public function mount(): void
    {
        parent::mount();

        $record = static::getResource()::getModel()::first();

        if ($record) {
            $url = static::getResource()::getUrl('edit', ['record' => $record]);
            
            if ($activeLocale = request()->query('activeLocale')) {
                $url .= (str_contains($url, '?') ? '&' : '?') . 'activeLocale=' . $activeLocale;
            }
            
            $this->redirect($url);
        }
    }
}
