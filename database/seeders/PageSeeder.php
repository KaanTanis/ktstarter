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
        $this->createHomePage();
        $this->createAboutPage();
    }

    protected function createHomePage()
    {
        Page::updateOrCreate([
            'slug' => '/',
        ], [
            'layout' => DefaultLayout::getName(),
            'title' => 'Ana Sayfa',
            'blocks' => [
                //
            ],
        ]);
    }

    protected function createAboutPage()
    {
        Page::updateOrCreate([
            'slug' => 'hakkimizda',
        ], [
            'layout' => DefaultLayout::getName(),
            'title' => 'Hakkımızda',
            'blocks' => [
                //
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
