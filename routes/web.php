<?php

use Livewire\Livewire;
use App\Livewire\Pages\Blog;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\About;
use App\Livewire\Pages\Blogs;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;


$filamentPaths = collect(filament()->getPanels())->map(fn ($panel) => ltrim($panel->getPath(), '/'))->implode('|');

/* Route::view('/', 'welcome'); */
    Livewire::setUpdateRoute(function ($handle) {
        return Route::post('/livewire/update', $handle);
    });
    
Route::get('/', PageController::class)->where([
    'page' => '^(?!'.$filamentPaths.'|filament|pulse).*$',
])->name('page');