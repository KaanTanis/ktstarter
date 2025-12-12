<?php

namespace App\Livewire;

use CyrildeWit\EloquentViewable\View;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Cache;

class StatsOverview extends StatsOverviewWidget
{
    protected ?string $heading = 'Analitik Genel Bakış';

    protected ?string $description = 'Web sitesi ziyaretçi istatistiklerinizin genel bakışını görüntüleyin.';

    private const CACHE_TTL = 60;

    protected function getStats(): array
    {
        return [
            Stat::make('Toplam Ziyaretçi Sayısı', $this->getVisitorsCount())
                ->icon('heroicon-o-users'),

            Stat::make('Diğer', 0)
                ->icon('heroicon-o-chart-bar'),
        ];
    }

    private function getVisitorsCount(): int
    {
        return $this->cache('visitors_count', function () {
            return View::query()
                ->count();
        });
    }

    private function cache(string $key, callable $resolver): mixed
    {
        return Cache::remember(
            $key,
            now()->addSeconds(self::CACHE_TTL),
            $resolver
        );
    }
}
