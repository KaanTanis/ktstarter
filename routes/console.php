<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('app:update-post-views-count')
    ->everyThirtyMinutes();

Schedule::command('app:generate-sitemap')
    ->daily();
