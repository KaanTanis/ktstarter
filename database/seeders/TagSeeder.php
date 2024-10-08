<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'Laravel',
            'PHP',
            'JavaScript',
            'Vue.js',
        ];

        collect($tags)->each(function ($tag) {
            \App\Models\Tag::create([
                'name' => $tag,
                'slug' => \Illuminate\Support\Str::slug($tag),
            ]);
        });
    }
}
