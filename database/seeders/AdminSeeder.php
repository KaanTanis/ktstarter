<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (! Role::whereName(config('filament-shield.super_admin.name'))->exists()) {
            Role::create([
                'name' => config('filament-shield.super_admin.name'),
                'guard_name' => filament()->getAuthGuard(),
            ]);
        }

        if (config('filament-shield.panel_user.enabled') && ! Role::whereName(config('filament-shield.filament_user.name'))->exists()) {
            Role::create([
                'name' => config('filament-shield.panel_user.name'),
                'guard_name' => filament()->getAuthGuard(),
            ]);
        }

        $admin = User::firstOrCreate(['email' => 'kt@kaantanis.com'], [
            'name' => 'Super Admin',
            'password' => bcrypt('123123123'),
        ]);

        $admin->assignRole(config('filament-shield.super_admin.name'));

        $user = User::firstOrCreate(['email' => 'admin@mail.com'], [
            'name' => 'Admin',
            'password' => bcrypt('12345678'),
        ]);

        $user->assignRole(config('filament-shield.panel_user.name'));

        Artisan::call('shield:generate', [
            '--panel' => 'admin',
            '--all' => true,
        ]);
        Artisan::call('shield:install admin');
    }
}
