<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (! app()->isProduction()) {
            Storage::disk()->deleteDirectory('livewire-tmp');

            $files = Storage::disk('public')->allFiles();
            Storage::disk('public')->delete($files);

            $this->command->info("\tStorage cleared.");
        }

        $this->call([
            AdminSeeder::class,
            SettingSeeder::class,
            // TagSeeder::class,
            // PostSeeder::class,
            PageSeeder::class,
        ]);
    }
}
