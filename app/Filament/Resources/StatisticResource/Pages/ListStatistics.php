<?php

namespace App\Filament\Resources\StatisticResource\Pages;

use App\Filament\Resources\StatisticResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

use Filament\Resources\Pages\ListRecords\Concerns\Translatable;

class ListStatistics extends ListRecords
{
    use Translatable;

    protected static string $resource = StatisticResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
