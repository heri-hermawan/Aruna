<?php

namespace App\Filament\Widgets;

use App\Models\Province;
use App\Models\Tradisi;
use App\Models\Peraturan;
use App\Models\Wisata;
use App\Models\Kuliner;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Provinsi', Province::count())
                ->description('38 Provinsi Indonesia 🇮🇩')
                ->descriptionIcon('heroicon-m-map')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17, 20, 25, 30, 35, 38])
                ->extraAttributes([
                    'class' => 'bg-gradient-to-br from-green-500 to-emerald-600',
                ]),
            
            Stat::make('Total Wisata', Wisata::count())
                ->description('Destinasi Wisata 🏝️')
                ->descriptionIcon('heroicon-m-map-pin')
                ->color('info')
                ->chart([5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 60, 80])
                ->extraAttributes([
                    'class' => 'bg-gradient-to-br from-blue-500 to-cyan-600',
                ]),
            
            Stat::make('Total Kuliner', Kuliner::count())
                ->description('Makanan Khas 🍲')
                ->descriptionIcon('heroicon-m-cake')
                ->color('warning')
                ->chart([5, 8, 12, 18, 22, 28, 32, 35, 37, 38, 39, 40])
                ->extraAttributes([
                    'class' => 'bg-gradient-to-br from-orange-500 to-amber-600',
                ]),
            
            Stat::make('Total Tradisi', Tradisi::count())
                ->description('Budaya Tradisional 🎭')
                ->descriptionIcon('heroicon-m-sparkles')
                ->color('danger')
                ->chart([3, 7, 12, 15, 20, 25, 28, 32, 35, 37, 39, 40])
                ->extraAttributes([
                    'class' => 'bg-gradient-to-br from-pink-500 to-rose-600',
                ]),
            
            Stat::make('Total Peraturan', Peraturan::count())
                ->description('Peraturan Daerah 📜')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary')
                ->chart([1, 1, 2, 2, 3, 3, 4, 4, 5, 5, 5, 5])
                ->extraAttributes([
                    'class' => 'bg-gradient-to-br from-purple-500 to-indigo-600',
                ]),
            
            Stat::make('Total Users', User::count())
                ->description('Pengguna Terdaftar 👥')
                ->descriptionIcon('heroicon-m-users')
                ->color('gray')
                ->chart([1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, User::count()])
                ->extraAttributes([
                    'class' => 'bg-gradient-to-br from-slate-500 to-zinc-600',
                ]),
        ];
    }
}
