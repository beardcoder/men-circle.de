<?php

namespace App\Http\Controllers;

use App\Mail\Signup;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

class SubscriptionController extends Controller
{
  public function signup(Request $request)
  {
    $request->validate([
      'email' => 'required|email',
      'name' => 'required',
    ]);

    $response = Http::withBasicAuth(
      config('listmonk.user'),
      config('listmonk.password'),
    )
      ->post(config('listmonk.url') . '/api/subscribers', [
        'email' => $request->email,
        'name' => $request->name,
        'lists' => [intval(config('listmonk.list'))],
      ])
      ->json();

    return back()->with('success', $response);
  }

  public function optin(Request $request)
  {
    $subscription = Subscription::where(
      'token',
      $request->get('token'),
    )->first();

    if (!$subscription) {
      return route('frontend.home');
    }

    $subscription->optin = true;
    $subscription->token = null;
    $subscription->save();

    return view('site.subscription', ['item' => $subscription]);
  }
}
