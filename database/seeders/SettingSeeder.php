<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::insert([
            [
                'key' => 'site_title',
                'value' => json_encode(['SİTE BAŞLIK']),
            ],
            [
                'key' => 'site_title_sperator',
                'value' => json_encode(['|']),
            ],
            [
                'key' => 'site_status',
                'value' => json_encode([true]),
            ],
            [
                'key' => 'site_status_description',
                'value' => json_encode(['Sitemiz şu an bakım aşamasındadır. Lütfen daha sonra tekrar deneyiniz.']),
            ],
            [
                'key' => 'seo_title',
                'value' => json_encode(['SEO BAŞLIK']),
            ],
            [
                'key' => 'seo_description',
                'value' => json_encode(['SEO AÇIKLAMA']),
            ],
        ]);
    }
}
