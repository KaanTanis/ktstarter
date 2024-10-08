<?php

namespace App\Livewire\Pages;

use App\Models\Blog as ModelsBlog;
use App\Services\Seo\BlogSEO;
use Artesaos\SEOTools\Traits\SEOTools;
use Livewire\Component;

class Blog extends Component
{
    use SEOTools;

    public $post;

    public $nextPost;

    public $previousPost;

    public function mount($slug)
    {
        $this->post = ModelsBlog::where('slug', $slug)->firstOrFail();

        $this->loadSEO(new BlogSEO($this->post));

        views($this->post)
            ->cooldown(now()->addMinutes(30))
            ->record();

        $this->nextPost = ModelsBlog::where('id', '>', $this->post->id)
            ->orderBy('id', 'asc')
            ->first() ?? ModelsBlog::orderBy('id', 'asc')->first();

        $this->previousPost = ModelsBlog::where('id', '<', $this->post->id)
            ->orderBy('id', 'desc')
            ->first() ?? ModelsBlog::orderBy('id', 'desc')->first();
    }

    public function render()
    {
        return view('livewire.pages.blog');
    }
}
