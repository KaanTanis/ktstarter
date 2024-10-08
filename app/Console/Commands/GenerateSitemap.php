<?php

namespace App\Console\Commands;

use App\Models\Blog;
use App\Models\Page;
use App\Models\Tag;
use App\Models\Work;
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
        $lastBlogChangeTime = Blog::max('updated_at');
        $homeLastChange = Page::where('type', 'home')->first()->updated_at;
        $aboutLastChange = Page::where('type', 'about')->first()->updated_at;
        $worksLastChange = Page::where('type', 'works')->first()->updated_at;

        $sitemap = Sitemap::create()
            ->add(Url::create(route('home'))
                ->setPriority(1)
                ->setLastModificationDate(Carbon::parse($homeLastChange))
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY))
            ->add(Url::create(route('blogs'))
                ->setPriority(0.8)
                ->setLastModificationDate(Carbon::parse($lastBlogChangeTime))
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY))
            ->add(Url::create(route('about'))
                ->setPriority(0.5)
                ->setLastModificationDate(Carbon::parse($aboutLastChange))
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
            ->add(Url::create(route('works'))
                ->setPriority(0.7)
                ->setLastModificationDate(Carbon::parse($worksLastChange))
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY));

        Blog::chunk(100, function ($blogs) use ($sitemap) {
            foreach ($blogs as $blog) {
                $url = Url::create(route('blog', $blog->slug))
                    ->setLastModificationDate($blog->updated_at)
                    ->setPriority(0.9)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY);

                if ($blog->cover) {
                    $url->addImage(Storage::url($blog->cover));
                }

                $sitemap->add($url);
            }
        });

        Work::chunk(100, function ($works) use ($sitemap) {
            foreach ($works as $work) {
                $url = Url::create(route('work', $work->slug))
                    ->setLastModificationDate($work->updated_at)
                    ->setPriority(0.9)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY);

                if ($work->cover) {
                    $url->addImage(Storage::url($work->cover));
                }

                $sitemap->add($url);
            }
        });

        Tag::chunk(100, function ($tags) use ($sitemap) {
            foreach ($tags as $tag) {
                $url = Url::create(route('blogs', ['selectedTag' => $tag->slug]))
                    ->setLastModificationDate($tag->updated_at)
                    ->setPriority(0.6)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY);

                $sitemap->add($url);
            }
        });

        $sitemap->writeToFile(public_path('sitemap.xml'));
    }
}
