<?php

namespace App\Livewire\Pages;

use App\Models\Work as ModelsWork;
use App\Services\Seo\WorkSEO;
use Artesaos\SEOTools\Traits\SEOTools;
use Livewire\Component;

class Work extends Component
{
    use SEOTools;

    public $work;

    public $previousWork;

    public $nextWork;

    public function mount($slug)
    {
        $this->work = ModelsWork::where('slug', $slug)->firstOrFail();

        views($this->work)
            ->cooldown(now()->addMinutes(30))
            ->record();

        $this->previousWork = ModelsWork::where('order_column', '<', $this->work->order_column)
            ->orderBy('order_column', 'desc')
            ->first() ?? ModelsWork::orderBy('order_column', 'desc')->first();

        $this->nextWork = ModelsWork::where('order_column', '>', $this->work->order_column)
            ->orderBy('order_column', 'asc')
            ->first() ?? ModelsWork::orderBy('order_column', 'asc')->first();

        $this->loadSEO(new WorkSEO($this->work));
    }

    public function render()
    {
        return view('livewire.pages.work');
    }
}
