<?php

namespace App\View\Components\Pages\Home;

use App\Models\Blog as ModelsBlog;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Blog extends Component
{
    public $posts;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->posts = ModelsBlog::orderByPublished()
            ->limit(3)
            ->with('tags')
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pages.home.blog');
    }
}
