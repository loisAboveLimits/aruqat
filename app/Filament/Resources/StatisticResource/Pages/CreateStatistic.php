<?php

namespace App\Filament\Resources\StatisticResource\Pages;

use App\Filament\Resources\StatisticResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use Filament\Resources\Pages\CreateRecord\Concerns\Translatable;

class CreateStatistic extends CreateRecord
{
    use Translatable;

    protected static string $resource = StatisticResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
