<?php

namespace Database\Factories;

use Database\Seeders\Traits\UploadFile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
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
            'title' => $title = $this->faker->sentence,
            'slug' => str()->slug($title),
            'content' => $this->faker->paragraphs(5, true),
            'cover' => $this->uploadFilePublicPath('assets/img/yellow.jpg'),
            'published_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'seo_title' => $this->faker->sentence,
            'seo_description' => $this->faker->paragraph,
        ];
    }
}
