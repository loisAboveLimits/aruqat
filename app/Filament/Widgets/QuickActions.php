<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\BlogPostResource;
use App\Filament\Resources\ServiceResource;
use App\Filament\Resources\TeamMemberResource;
use Filament\Widgets\Widget;

class QuickActions extends Widget
{
    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 'full';

    protected static string $view = 'filament.widgets.quick-actions';

    public function getActions(): array
    {
        return [
            [
                'label' => 'Add New Service',
                'icon' => 'heroicon-o-briefcase',
                'url' => ServiceResource::getUrl('create'),
            ],
            [
                'label' => 'Add Team Member',
                'icon' => 'heroicon-o-user-plus',
                'url' => TeamMemberResource::getUrl('create'),
            ],
            [
                'label' => 'New Blog Post',
                'icon' => 'heroicon-o-document-plus',
                'url' => BlogPostResource::getUrl('create'),
            ],
            [
                'label' => 'Visit Website',
                'icon' => 'heroicon-o-globe-alt',
                'url' => url('/'),
                'new_tab' => true,
            ],
        ];
    }
}
