<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::directive('route', function ($expression) {
            return "<?php echo route($expression); ?>";
        });

        // force https
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        Model::shouldBeStrict();
    }
}
