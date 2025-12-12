<?php

namespace App\Models\Traits;

use Spatie\Sitemap\Tags\Url;

trait HasSitemapAttributes
{
    public function getSitemapPriority(): float
    {
        // Eğer manuel ayarlanmışsa onu kullan
        if (isset($this->sitemap_priority)) {
            return $this->sitemap_priority;
        }

        // Akıllı hesaplama
        return $this->calculateSitemapPriority();
    }

    protected function calculateSitemapPriority(): float
    {
        $priority = 0.5;

        // Son güncelleme zamanına göre
        if ($this->updated_at->isToday()) {
            $priority += 0.2;
        } elseif ($this->updated_at->isCurrentMonth()) {
            $priority += 0.1;
        }

        // View sayısına göre (eğer varsa)
        // @todo: elequent views implementasyonu ekle
        if (isset($this->views_count)) {
            if ($this->views_count > 1000) {
                $priority += 0.2;
            } elseif ($this->views_count > 500) {
                $priority += 0.1;
            }
        }

        return min(1.0, $priority);
    }

    public function getSitemapChangeFrequency(): string
    {
        if (isset($this->sitemap_change_freq)) {
            return $this->sitemap_change_freq;
        }

        return $this->calculateChangeFrequency();
    }

    protected function calculateChangeFrequency(): string
    {
        $daysSinceUpdate = $this->updated_at->diffInDays(now());

        if ($daysSinceUpdate < 1) {
            return Url::CHANGE_FREQUENCY_DAILY;
        }
        if ($daysSinceUpdate < 7) {
            return Url::CHANGE_FREQUENCY_WEEKLY;
        }
        if ($daysSinceUpdate < 30) {
            return Url::CHANGE_FREQUENCY_MONTHLY;
        }

        return Url::CHANGE_FREQUENCY_YEARLY;
    }
}
