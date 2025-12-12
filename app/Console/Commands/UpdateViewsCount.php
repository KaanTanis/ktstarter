<?php

namespace App\Console\Commands;

use App\Models\Page;
use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateViewsCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-views-count';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the views count';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Post::chunk(100, function ($posts) {
            $posts->each(function ($post) {
                $post->update([
                    'views_count' => views($post)->count(),
                ]);
            });
        });

        Page::chunk(100, function ($pages) {
            $pages->each(function ($page) {
                $page->loadMissing('parent');
                $page->update([
                    'views_count' => views($page)->count(),
                ]);
            });
        });

        $this->info('The views count has been updated.');

        Log::channel('custom')
            ->info('The views count has been updated.');
    }
}
