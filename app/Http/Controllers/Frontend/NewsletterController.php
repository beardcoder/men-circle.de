<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsletterRegisterRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

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

    flash('Vielen dank für deine Anmeldung. Du hast eine E-Mail bekommen um deine Anmeldung nochmals zu bestätigen');
    return back();
  }
}
