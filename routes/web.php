<?php

use Livewire\Livewire;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

$filamentPaths = collect(filament()->getPanels())->map(fn ($panel) => ltrim($panel->getPath(), '/'))->implode('|');

Livewire::setUpdateRoute(fn ($handle) => Route::post('/livewire/update', $handle));

Route::get('{filamentFabricatorPage?}', PageController::class)->where([
    'page' => "^(?!.$filamentPaths|filament|pulse).*$",
])->name('page');

