<?php

namespace App\Console\Commands;

use App\Models\Page;
use App\Models\Project;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
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
        $homeLastChange = Page::where('slug->'.app()->getLocale(), '/')->first()->updated_at;
        $homeUrl = Page::where('slug->'.app()->getLocale(), '/')->first()->url;

        $sitemap = Sitemap::create()
            ->add(Url::create($homeUrl)
                ->setPriority(1)
                ->setLastModificationDate(Carbon::parse($homeLastChange))
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY));

        // Project::chunk(100, function ($projects) use ($sitemap) {
        //     foreach ($projects as $project) {
        //         $url = Url::create(route('project', $project->slug))
        //             ->setLastModificationDate($project->updated_at)
        //             ->setPriority(0.9)
        //             ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY);

        //         if ($project->cover_2) {
        //             $url->addImage(Storage::url($project->cover_2));
        //         }

        //         $sitemap->add($url);
        //     }
        // });

        $sitemap->writeToFile(public_path('sitemap.xml'));
    }
}
