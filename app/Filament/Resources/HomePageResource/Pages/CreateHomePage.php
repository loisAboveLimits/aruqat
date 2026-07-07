<?php

namespace App\Filament\Resources\HomePageResource\Pages;

use App\Filament\Resources\HomePageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHomePage extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = HomePageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateRecord\Concerns\Translatable::makeAction(),
        ];
    }
}
