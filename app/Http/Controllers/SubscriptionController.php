<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SubscriptionController extends Controller
{
  public function signup(Request $request)
  {
    $request->validate([
      'email' => 'required|email',
      'name' => 'required',
    ]);

    $response = Http::withBasicAuth(config('listmonk.user'), config('listmonk.password'))
      ->post(config('listmonk.url') . '/api/subscribers', [
        'email' => $request->email,
        'name' => $request->name,
        'lists' => [intval(config('listmonk.list'))],
      ])
      ->json();

    return back()->with('success', $response);
  }
}
