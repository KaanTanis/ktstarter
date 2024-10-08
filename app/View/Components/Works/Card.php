<?php

namespace App\View\Components\Works;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    public $work;

    /**
     * Create a new component instance.
     */
    public function __construct($work)
    {
        $this->work = $work;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.works.card');
    }
}
