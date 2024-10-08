<?php

namespace Database\Factories;

use Database\Seeders\Traits\UploadFile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Work>
 */
class WorkFactory extends Factory
{
    use UploadFile;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'slug' => $this->faker->slug,
            'summary' => $this->faker->sentence,
            'type' => $this->faker->randomElement(array_keys(\App\Enums\WorkEnums::toSelectOptions())),
            'cover' => $this->uploadFilePublicPath('assets/img/yellow.jpg'),
            'code_field' => [
                ['prefix' => '$', 'color_class' => '', 'code' => 'composer create-project laravel/laravel kaantanis'],
                ['prefix' => '>', 'color_class' => 'text-warning', 'code' => './vendor/bin/dep deploy'],
                ['prefix' => '>', 'color_class' => 'text-success', 'code' => 'Done!'],
            ],
            'desktop_mockup' => $this->uploadFilePublicPath('assets/img/ktwork.png'),
            'mobile_mockup' => $this->uploadFilePublicPath('assets/img/ktworkm.png'),
            'web_url' => $this->faker->url,
            'body' => $this->faker->paragraph,
            'properties' => [
                ['key' => 'client', 'value' => 'John Doe'],
                ['key' => 'date', 'value' => '2024-09-07'],
                ['key' => 'category', 'value' => 'Web Development'],
            ],
            'seo_title' => $this->faker->sentence,
            'seo_description' => $this->faker->sentence,
            'published_at' => now(),
        ];
    }
}
