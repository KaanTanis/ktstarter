<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = \App\Models\Tag::all();

        \App\Models\Post::factory(3)->create()->each(function ($post) use ($tags) {
            $post->tags()->attach($tags->random(rand(1, 2))->pluck('id')->toArray());
        });
    }
}
