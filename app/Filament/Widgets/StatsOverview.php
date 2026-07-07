<?php

namespace App\Filament\Widgets;

use App\Models\ContactMessage;
use App\Models\Service;
use App\Models\TeamMember;
use App\Filament\Resources\ServiceResource;
use App\Filament\Resources\TeamMemberResource;
use App\Filament\Resources\ContactMessageResource;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Services', Service::where('is_active', true)->count())
                ->description('Services available on site')
                ->descriptionIcon('heroicon-m-briefcase')
                ->color('primary')
                ->url(ServiceResource::getUrl())
                ->chart([7, 3, 4, 5, 6, 3, 5, 8]),

            Stat::make('Team Members', TeamMember::where('is_active', true)->count())
                ->description('Total employees')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary')
                ->url(TeamMemberResource::getUrl())
                ->chart([2, 4, 3, 5, 4, 6, 5, 7]),

            Stat::make('Contact Messages', ContactMessage::count())
                ->description('Messages received from clients')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('primary')
                ->url(ContactMessageResource::getUrl())
                ->chart([3, 5, 4, 7, 5, 8, 6, 9]),
        ];
    }
}
