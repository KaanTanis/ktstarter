<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

$filamentPaths = collect(filament()->getPanels())->map(fn ($panel) => ltrim($panel->getPath(), '/'))->implode('|');

Livewire::setUpdateRoute(fn ($handle) => Route::post('/livewire/update', $handle));

Route::get('{?slug}', PageController::class)->where([
    'page' => "^(?!.$filamentPaths|filament|pulse).*$",
])->name('page');
