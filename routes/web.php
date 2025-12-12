<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

$panelPaths = collect(filament()->getPanels())
    ->map(fn ($panel) => ltrim($panel->getPath(), '/'))
    ->filter();

$excludedPaths = $panelPaths
    ->merge(['filament', 'pulse', 'haberler'])
    ->implode('|');

Livewire::setUpdateRoute(fn ($handle) => Route::post('/livewire/update', $handle));

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () use ($excludedPaths) {
    Route::get('/{filamentFabricatorPage:slug?}', PageController::class)
        ->where('filamentFabricatorPage', "^(?!($excludedPaths)).*$")
        ->name('page');

    Route::get('/haberler/{post:slug}', function () {
        abort(404);
    })->name('posts.show');
});
