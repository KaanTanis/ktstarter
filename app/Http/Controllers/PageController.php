<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Services\Seo\PageSEO;
use Artesaos\SEOTools\Traits\SEOTools;

class PageController extends Controller
{
    use SEOTools;

    /**
     * Handle the incoming request.
     */
    public function __invoke(?Page $page)
    {
        if ($page === null) {
            $page = Page::findBySlug('/');
        }

        $this->loadSEO(new PageSEO($page));

        // views($page)->cooldown(now()->addHours(6))->record();

        return $page->render();
    }
}
