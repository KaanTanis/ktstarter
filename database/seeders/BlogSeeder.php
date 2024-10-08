<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = \App\Models\Tag::all();

        \App\Models\Blog::factory(10)->create()->each(function ($blog) use ($tags) {
            $blog->tags()->attach($tags->random(rand(1, 3))->pluck('id')->toArray());
        });
    }
}
