<?php

namespace App\Http\Controllers\Frontend;

use A17\Twill\Facades\TwillAppSettings;
use A17\Twill\Models\Contracts\TwillModelContract;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Repositories\PageRepository;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\URL;

class PageDisplayController extends Controller
{
  public function show(string $slug, PageRepository $pageRepository): View
  {
    /** @var \App\Models\Page $page */

    $page = Cache::rememberForever("pages.{$slug}", function () use ($slug, $pageRepository) {
      return $pageRepository->forSlug($slug);
    });

    if (!$page) {
      abort(404);
    }

    self::setSeoData($page);
    SEOTools::opengraph()->setUrl(URL::to($slug));
    SEOTools::setTitle($page->title);
    OpenGraph::addProperty('type', 'website');

    return view('site.page', ['item' => $page]);
  }

  public function home(): View
  {
    /** @var \App\Models\Page $page */
    $page = Cache::rememberForever('pages.home', function () {
      return TwillAppSettings::get('homepage.homepage.page')->first();
    });

    if ($page->published) {
      self::setSeoData($page);
      SEOTools::setTitle('Männerkreis Straubing und Niederbayern');
      SEOTools::opengraph()->setUrl(URL::to('/'));
      return view('site.page', ['item' => $page]);
    }

    abort(404);
  }

  private static function setSeoData(Page|TwillModelContract $page)
  {
    if ($page->description) {
      SEOTools::setDescription($page->description);
    }

    SEOTools::opengraph()->addProperty('type', 'website');
    SEOTools::jsonLd()->addImage('https://mens-circle.de/assets/web/images/logo.png');
  }
}
