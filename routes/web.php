<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

$filamentPaths = collect(filament()->getPanels())->map(fn ($panel) => ltrim($panel->getPath(), '/'))->implode('|');

Livewire::setUpdateRoute(fn ($handle) => Route::post('/livewire/update', $handle));

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () use ($filamentPaths) {
    Route::get('{filamentFabricatorPage?}', PageController::class)->where([
        'page' => "^(?!.$filamentPaths|filament|pulse).*$",
    ])->name('page');
});
