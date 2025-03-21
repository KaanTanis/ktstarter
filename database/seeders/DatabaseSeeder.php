<?php

namespace Database\Seeders;

use App\Models\User;
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

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'kt@kaantanis.com',
            'password' => bcrypt('123123123'),
        ]);

        $this->call([
            SettingSeeder::class,
            TagSeeder::class,
            BlogSeeder::class,
        ]);
    }
}
