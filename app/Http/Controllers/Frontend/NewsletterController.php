<?php

namespace App\Http\Controllers\Frontend;

use A17\Twill\Facades\TwillAppSettings;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewsletterRegisterRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class NewsletterController extends Controller
{
  public function register(NewsletterRegisterRequest $request)
  {
    Http::withBasicAuth(config('listmonk.user'), config('listmonk.password'))->post(
      config('listmonk.url') . '/api/subscribers',
      [
        'email' => $request->email,
        'name' => $request->name,
        'lists' => [intval(config('listmonk.list'))],
      ],
    );

    $page = TwillAppSettings::get('homepage.email.thanks')->first();

    return redirect()->route('frontend.page', ['slug' => $page->slug]);
  }
}
