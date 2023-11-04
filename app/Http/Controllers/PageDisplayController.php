<?php

namespace App\Http\Controllers;

use A17\Twill\Facades\TwillAppSettings;
use App\Repositories\PageRepository;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Contracts\View\View;

class PageDisplayController extends Controller
{
  public function show(string $slug, PageRepository $pageRepository): View
  {
    $page = $pageRepository->forSlug($slug);

    if (!$page) {
      abort(404);
    }

    SEOMeta::setTitle($page->title);
    if ($page->description) {
      SEOMeta::setDescription($page->description);
    }

    return view('site.page', ['item' => $page]);
  }

  public function home(): View
  {
    if (TwillAppSettings::get('homepage.homepage.page')->isNotEmpty()) {
      /** @var \App\Models\Page $page */
      $page = TwillAppSettings::get('homepage.homepage.page')->first();

      if ($page->published) {
        SEOMeta::setTitle($page->title);
        if ($page->description) {
          SEOMeta::setDescription($page->description);
        }
        return view('site.page', ['item' => $page]);
      }
    }

    abort(404);
  }
}
