<?php

namespace App\Livewire\Pages;

use App\Models\Blog;
use App\Models\Page;
use App\Models\Tag;
use App\Services\Seo\BlogsSEO;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Renderless;
use Livewire\Attributes\Url;
use Livewire\Component;

class Blogs extends Component
{
    use SEOTools;

    public $posts = [];

    public $perPage = 6;

    public $currentPage = 1;

    public $loadMoreButton = false;

    #[Url]
    public $search = '';

    public $orderBy = 'latest';

    #[Url]
    public $selectedTag = null;

    public $tags = [];

    public function mount(): void
    {
        $this->loadSEO(new BlogsSEO);

        views(Page::where('type', 'blogs')->first())
            ->cooldown(now()->addMinutes(30))
            ->record();

        $this->getTags();
        $this->getPosts();
    }

    #[Computed]
    public function getTags()
    {
        $this->tags = Tag::all();
    }

    #[Computed]
    public function getFilteredPosts(): LengthAwarePaginator
    {
        $query = Blog::published()
            ->with('tags')
            ->when($this->search, fn ($q) => $q->whereRaw('lower(title) like ?', ['%'.strtolower($this->search).'%']))
            ->when($this->selectedTag, fn ($q) => $q->whereHas('tags', fn ($q) => $q->where('tags.slug', $this->selectedTag)));

        $this->applyOrdering($query);

        return $query->paginate($this->perPage, ['*'], 'page', $this->currentPage);
    }

    public function getPosts(): void
    {
        $paginated = $this->getFilteredPosts();

        $this->posts = array_merge($this->posts, $paginated->items());
        $this->loadMoreButton = $paginated->hasMorePages();
    }

    public function applyOrdering($query): void
    {
        match ($this->orderBy) {
            'latest' => $query->orderBy('published_at', 'desc'),
            'oldest' => $query->orderBy('published_at', 'asc'),
            'most_viewed' => $query->orderBy('views_count', 'desc'),
            default => $query,
        };
    }

    public function updateFilters(): void
    {
        $this->currentPage = 1;
        $this->posts = [];
        $this->getPosts();
    }

    public function updatedSearch(): void
    {
        $this->updateFilters();
    }

    public function selectTag($tag): void
    {
        $this->selectedTag = $this->selectedTag === $tag ? null : $tag;
        $this->updateFilters();
    }

    public function order($type): void
    {
        $this->orderBy = $type;
        $this->updateFilters();
    }

    public function loadMore(): void
    {
        $this->currentPage++;
        $this->getPosts();

        $this->dispatch('loadMore');
    }

    public function resetFilter(): void
    {
        $this->search = $this->selectedTag = null;
        $this->updateFilters();
    }

    #[Renderless]
    public function orderTypes(): array
    {
        return [
            'latest' => trans('Önce En Yeni'),
            'oldest' => trans('Önce En Eski'),
            'most_viewed' => trans('En Çok Görüntülenen'),
        ];
    }

    public function render()
    {
        return view('livewire.pages.blogs');
    }
}
