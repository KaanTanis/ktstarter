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

        \App\Models\Blog::factory(3)->create()->each(function ($blog) use ($tags) {
            $blog->tags()->attach($tags->random(rand(1, 2))->pluck('id')->toArray());
        });
    }
}
