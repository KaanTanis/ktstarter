<?php

namespace Database\Seeders;

use App\Filament\Fabricator\Layouts\DefaultLayout;
use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Page::updateOrCreate([
            'title' => 'Ana Sayfa',
            'slug' => '/',
        ], [
            'layout' => DefaultLayout::getName(),
            'blocks' => [
                $this->createBlock('text', [
                    'text' => 'lorem ipsum dolor sit amet consectetur adipiscing elit'
                ])
            ]
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
