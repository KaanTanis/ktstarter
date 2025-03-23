<?php

namespace Database\Seeders;

use App\Filament\Fabricator\Layouts\DefaultLayout;
use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Page::updateOrCreate([
            'slug->tr' => '/',
            'slug->en' => '/',
        ], [
            'layout' => DefaultLayout::getName(),
            'title' => [
                'tr' => 'Ana Sayfa',
                'en' => 'Home',
            ],
            'blocks' => [
                'tr' => $tr = [
                    $this->createBlock('text', [
                        'text' => 'lorem ipsum dolor sit amet consectetur adipiscing elit',
                    ]),
                ],
                'en' => $tr,
            ],
        ]);
    }

    protected function createBlock(string $name, array $fields)
    {
        return [
            'data' => $fields,
            'type' => $name,
        ];
    }
}
