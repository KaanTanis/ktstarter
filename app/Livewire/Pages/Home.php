<?php

namespace App\Livewire\Pages;

use App\Models\Page;
use App\Services\Seo\HomeSEO;
use Artesaos\SEOTools\Traits\SEOTools;
use Livewire\Component;

class Home extends Component
{
    use SEOTools;

    public $page;

    public function mount()
    {
        $this->page = Page::where('type', 'home')->firstOrFail();

        $this->loadSEO(new HomeSEO($this->page));

        views($this->page)
            ->cooldown(now()->addMinutes(30))
            ->record();
    }

    public function render()
    {
        return view('livewire.pages.home');
    }
}
