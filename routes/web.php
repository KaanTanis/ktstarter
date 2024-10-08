<?php

use App\Livewire\Pages\About;
use App\Livewire\Pages\Blog;
use App\Livewire\Pages\Blogs;
use App\Livewire\Pages\Home;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/bloglar', Blogs::class)->name('blogs');
Route::get('/bloglar/{slug}', Blog::class)->name('blog');
Route::get('/hakkimda', About::class)->name('about');
