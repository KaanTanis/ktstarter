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
                'value' => json_encode('Site Başlık'),
                'data_type' => 'string',
            ],
            [
                'key' => 'site_title_sperator',
                'value' => json_encode('|'),
                'data_type' => 'string',
            ],
            [
                'key' => 'site_status',
                'value' => json_encode(true),
                'data_type' => 'boolean',
            ],
            [
                'key' => 'site_status_description',
                'value' => json_encode('Sitemiz şu an bakım aşamasındadır. Lütfen daha sonra tekrar deneyiniz.'),
                'data_type' => 'string',
            ],
            [
                'key' => 'seo_title',
                'value' => json_encode('SEO BAŞLIK'),
                'data_type' => 'string',
            ],
            [
                'key' => 'seo_description',
                'value' => json_encode('SEO AÇIKLAMA'),
                'data_type' => 'string',
            ],
        ]);
    }
}
