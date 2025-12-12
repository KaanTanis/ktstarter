<?php

namespace Database\Factories;

use Database\Seeders\Traits\UploadFile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories.Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    use UploadFile;

    protected $model = \App\Models\Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => [
                'tr' => $this->faker->sentence,
                'en' => $this->faker->sentence,
            ],
            'slug' => [
                'tr' => $this->faker->slug,
                'en' => $this->faker->slug,
            ],
            'content' => [
                'tr' => $this->faker->paragraphs(3, true),
                'en' => $this->faker->paragraphs(3, true),
            ],
            'cover' => $this->uploadFilePublicPath('assets/img/post.jpg', 'posts'),
            'published_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'seo_title' => [
                'tr' => $this->faker->sentence,
                'en' => $this->faker->sentence,
            ],
            'seo_description' => [
                'tr' => $this->faker->paragraph,
                'en' => $this->faker->paragraph,
            ],
        ];
    }
}
