<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Media extends Component
{
    // @todo helper, provider, advanced blade render and object type support

    /**
     * Create a new component instance.
     */
    public function __construct(
        public mixed $src,
        public ?string $alt = '',
        public ?string $class = '',
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.media');
    }
}
