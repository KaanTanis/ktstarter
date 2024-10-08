<?php

namespace App\View\Components\Pages\Home;

use App\Models\Page;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Steps extends Component
{
    public $steps;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->steps = Page::where('type', 'home')->first()->data['how_it_works']['steps'];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pages.home.steps');
    }
}
