<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Services\Seo\PageSEO;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Http\Request;

class PageController extends Controller
{
    use SEOTools;

    /**
     * Handle the incoming request.
     */
    public function __invoke(?Page $filamentFabricatorPage = null)
    {
        if ($filamentFabricatorPage === null) {
            $filamentFabricatorPage = Page::where('slug', '/')->first();
        }

        $this->loadSEO(new PageSEO($filamentFabricatorPage));

        views($filamentFabricatorPage)->cooldown(now()->addHours(6))->record();

        return $filamentFabricatorPage->render();
    }
}
