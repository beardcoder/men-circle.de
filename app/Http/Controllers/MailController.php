<?php

namespace App\Http\Controllers;

use App\Mail\Signup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
  public function signup(Request $request)
  {
    Mail::to($request->get('email'))->send(
      new Signup($request->get('name'), $request->get('email')),
    );

    return back()->with('success');
  }
}
