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
                'value' => 'SİTE BAŞLIK',
            ],
            [
                'key' => 'site_title_sperator',
                'value' => '|',
            ],
            [
                'key' => 'site_status',
                'value' => true,
            ],
            [
                'key' => 'site_status_description',
                'value' => 'Sitemiz şu an bakım aşamasındadır. Lütfen daha sonra tekrar deneyiniz.',
            ],
            [
                'key' => 'seo_title',
                'value' => 'SEO BAŞLIK',
            ],
            [
                'key' => 'seo_description',
                'value' => 'SEO AÇIKLAMA',
            ],
        ]);
    }
}
