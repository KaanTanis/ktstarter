<?php

namespace App\View\Components\Pages\Home;

use App\Models\Page;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Hero extends Component
{
    public $hero;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->hero = Page::where('type', 'home')->first()->data['hero'];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pages.home.hero');
    }
}
