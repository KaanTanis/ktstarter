<?php

namespace App\Console\Commands;

use App\Models\Page;
use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate sitemap.xml file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $homePage = Page::where('slug', '/')->first();

        if (! $homePage) {
            $this->warn('Homepage not found.');

            return self::FAILURE;
        }

        $sitemap = Sitemap::create()
            ->add($this->createUrlFromModel($homePage, 1, Url::CHANGE_FREQUENCY_DAILY));

        // Pages
        Page::where('slug', '!=', '/')
            ->where('include_in_sitemap', true) // Sitemap'e dahil edilecekler
            ->chunk(100, function ($pages) use ($sitemap) {
                foreach ($pages as $page) {
                    $sitemap->add($this->createUrlFromModel($page));
                }
            });

        // Posts
        Post::where('published_at', '<=', Carbon::now())
            ->where('include_in_sitemap', true)
            ->chunk(100, function ($posts) use ($sitemap) {
                foreach ($posts as $post) {
                    $sitemap->add($this->createUrlFromModel($post));
                }
            });

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated successfully!');
    }

    protected function createUrlFromModel($model, ?float $priority = null, ?string $changeFreq = null): Url
    {
        return Url::create($model->url ?? url('/'))
            ->setPriority($priority ?? $model->getSitemapPriority())
            ->setLastModificationDate($model->updated_at)
            ->setChangeFrequency($changeFreq ?? $model->getSitemapChangeFrequency());
    }
}
