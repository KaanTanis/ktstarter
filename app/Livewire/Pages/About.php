<?php

namespace App\Livewire\Pages;

use App\Models\Page;
use App\Services\Seo\AboutSEO;
use Artesaos\SEOTools\Traits\SEOTools;
use Livewire\Component;

class About extends Component
{
    use SEOTools;

    public $page;

    public function mount()
    {
        $this->page = Page::where('type', 'about')->firstOrFail();

        $this->loadSEO(new AboutSEO($this->page));

        views($this->page)
            ->cooldown(now()->addMinutes(30))
            ->record();
    }

    public function render()
    {
        return view('livewire.pages.about');
    }
}
