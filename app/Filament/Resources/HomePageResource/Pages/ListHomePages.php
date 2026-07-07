<?php

namespace App\Filament\Resources\HomePageResource\Pages;

use App\Filament\Resources\HomePageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHomePages extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = HomePageResource::class;

    public function mount(): void
    {
        parent::mount();

        $record = static::getResource()::getModel()::first();
        
        if ($record) {
            redirect(static::getResource()::getUrl('edit', ['record' => $record]));
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
