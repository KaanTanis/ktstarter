<?php

namespace Database\Seeders;

use App\Models\Page;
use Database\Seeders\Traits\UploadFile;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    use UploadFile;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedHome();
    }

    public function seedHome()
    {
        Page::create([
            'type' => 'home',
            'data' => [
                //
            ],
        ]);

        Page::create([
            'type' => 'about',
            'data' => [
                //
            ],
        ]);

        Page::create([
            'type' => 'contact',
            'data' => [
                //
            ],
        ]);

        Page::create([
            'type' => 'blogs',
            'data' => [
                //
            ],
        ]);
    }
}
