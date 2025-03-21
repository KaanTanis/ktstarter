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
                'key' => 'site_status',
                'value' => json_encode(true),
                'data_type' => 'boolean',
            ],
            [
                'key' => 'site_status_description',
                'value' => json_encode('Sitemiz şu an bakım aşamasındadır. Lütfen daha sonra tekrar deneyiniz.'),
                'data_type' => 'string',
            ],
        ]);
    }
}
