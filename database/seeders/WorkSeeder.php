<?php

namespace Database\Seeders;

use App\Models\Work;
use Database\Seeders\Traits\UploadFile;
use Illuminate\Database\Seeder;

class WorkSeeder extends Seeder
{
    use UploadFile;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $works = [
            [
                'title' => "Kaan\nTanış",
                'slug' => 'kaantanis',
                'cover' => $this->uploadFilePublicPath('assets/img/kaantanis.jpg'),
                'order_column' => 1,
            ],
            [
                'title' => "Meze\nMozart",
                'slug' => 'meze-mozart',
                'cover' => $this->uploadFilePublicPath('assets/img/mezemozart.jpg'),
                'order_column' => 2,
            ],
            [
                'title' => "Diyetisyen\nAyda Uçar",
                'slug' => 'diyetisyen-ayda-ucar',
                'cover' => $this->uploadFilePublicPath('assets/img/aydaucar.jpg'),
                'order_column' => 3,
            ],
        ];

        foreach ($works as $work) {
            Work::factory()->create($work);
        }
    }
}
