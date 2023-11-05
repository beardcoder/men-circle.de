<?php

namespace App\Http\Controllers;

use App\Mail\Signup;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Ramsey\Uuid\Uuid;

class SubscriptionController extends Controller
{
  public function signup(Request $request)
  {
    $request->validate([
      'email' => 'required|email',
      'name' => 'required',
    ]);

    $existing = Subscription::where('email', $request->get('email'))->first();

    if (!$existing) {
      $subscription = Subscription::create([
        'name' => $request->get('name'),
        'email' => $request->get('email'),
        'token' => Uuid::uuid4()->toString(),
      ]);
    } else {
      $subscription = $existing;
      $subscription->token = Uuid::uuid4()->toString();
    }

    $subscription->save();

    Mail::to($request->get('email'))->send(
      new Signup(
        $subscription->name,
        $subscription->email,
        $subscription->token,
      ),
    );

    return back()->with('success');
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
