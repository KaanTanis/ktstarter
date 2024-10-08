<?php

namespace App\View\Components\Pages\Home;

use App\Models\Page;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class About extends Component
{
    public $about;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->about = Page::where('type', 'home')->first()->data['about'];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pages.home.about');
    }
}
