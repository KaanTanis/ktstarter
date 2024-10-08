<?php

namespace App\Livewire\Pages;

use App\Models\Page;
use App\Models\Work;
use App\Services\Seo\WorksSEO;
use Artesaos\SEOTools\Traits\SEOTools;
use Livewire\Component;

class Works extends Component
{
    use SEOTools;

    public $works;

    public $perPage = 4;

    public $hasMore = true;

    public $page;

    public function mount()
    {
        $this->page = Page::where('type', 'works')->first();

        $this->loadSEO(new WorksSEO($this->page));

        views($this->page)
            ->cooldown(now()->addMinutes(30))
            ->record();

        $this->works = Work::query()
            ->orderBy('order_column')
            ->take($this->perPage)
            ->get();

        if (Work::count() <= $this->works->count()) {
            $this->hasMore = false;
        }
    }

    public function loadMore()
    {
        $loadedCount = $this->works->count();

        $moreWorks = Work::query()
            ->orderBy('order_column')
            ->skip($loadedCount)
            ->take($this->perPage)
            ->get();

        $this->works = $this->works->concat($moreWorks);

        if (Work::count() <= $this->works->count()) {
            $this->hasMore = false;
        }
    }

    public function render()
    {
        return view('livewire.pages.works');
    }
}
