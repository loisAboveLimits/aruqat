<?php

namespace App\Filament\Pages;

class Dashboard extends \Filament\Pages\Dashboard
{
    protected static ?string $title = 'Platform Overview';

    public function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Widgets\StatsOverview::class,
            \App\Filament\Widgets\QuickActions::class,
        ];
    }

    public function getWidgets(): array
    {
        return [
            // Other widgets that should appear below the header
        ];
    }
}
