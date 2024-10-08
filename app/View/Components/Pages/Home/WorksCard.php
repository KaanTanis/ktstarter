<?php

namespace App\View\Components\Pages\Home;

use App\Models\Work;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class WorksCard extends Component
{
    public $works;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->works = Work::orderBy('order_column')->limit(2)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pages.home.works-card');
    }
}
