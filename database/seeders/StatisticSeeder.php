<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Statistic;

class StatisticSeeder extends Seeder
{
    public function run(): void
    {
        $stats = [
            [
                'title' => [
                    'ar' => 'عدد القضايا',
                    'en' => 'Cases Handled',
                ],
                'value' => 305,
                'sort_order' => 1,
            ],
            [
                'title' => [
                    'ar' => 'سنوات الخبرة',
                    'en' => 'Years of Experience',
                ],
                'value' => 35,
                'sort_order' => 2,
            ],
            [
                'title' => [
                    'ar' => 'عدد العملاء',
                    'en' => 'Number of Clients',
                ],
                'value' => 255,
                'sort_order' => 3,
            ],
        ];

        foreach ($stats as $stat) {
            Statistic::create($stat);
        }
    }
}
