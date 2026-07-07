<?php

namespace App\Filament\Resources\StatisticResource\Pages;

use App\Filament\Resources\StatisticResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

use Filament\Resources\Pages\EditRecord\Concerns\Translatable;

class EditStatistic extends EditRecord
{
    use Translatable;

    protected static string $resource = StatisticResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
