<?php

namespace App\Console\Commands;

use App\Models\Blog;
use App\Models\Setting;
use CyrildeWit\EloquentViewable\View;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdatePostViewsCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-post-views-count';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the views count of the posts';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Blog::chunk(100, function ($posts) {
            $posts->each(function ($post) {
                $post->update([
                    'views_count' => views($post)->count(),
                ]);
            });
        });

        $totalVisitor = View::query()
            ->count();

        $existingSetting = Setting::where('key', 'total_views_count')->first();
        if (! $existingSetting || $existingSetting->value != $totalVisitor) {
            Setting::updateOrCreate(
                ['key' => 'total_views_count'],
                ['value' => $totalVisitor]
            );
        }

        Log::channel('custom')
            ->info('The views count of the posts has been updated.');
    }
}
