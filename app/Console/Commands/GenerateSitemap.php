<?php

namespace App\Console\Commands;

use App\Models\Page;
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
            $this->warn('Homepage not found. Please seed pages before generating sitemap.');

            return self::FAILURE;
        }

        $homeLastChange = $homePage->updated_at;
        $homeUrl = $homePage->url ?? url('/');

        $sitemap = Sitemap::create()
            ->add(Url::create($homeUrl)
                ->setPriority(1)
                ->setLastModificationDate(Carbon::parse($homeLastChange))
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY));

        Page::where('slug', '!=', '/')->chunk(100, function ($pages) use ($sitemap) {
            foreach ($pages as $page) {
                $sitemap->add(
                    Url::create($page->url ?? url('/'))
                        ->setPriority(0.6)
                        ->setLastModificationDate($page->updated_at)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                );
            }
        });

        $sitemap->writeToFile(public_path('sitemap.xml'));
    }
}
