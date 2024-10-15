<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GeneratePage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-page {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new page';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');

        $stub = File::get(base_path('stubs/page.stub'));

        $content = str_replace(
            ['{{ class }}', '{{ pageType }}'],
            [$name, str($name)->slug()],
            $stub
        );

        $filePath = base_path("app/Filament/Clusters/CustomPages/Pages/{$name}.php");

        File::put($filePath, $content);

        $this->info("Page {$name} was successfully created!");
    }
}
