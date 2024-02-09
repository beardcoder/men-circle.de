<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\ResponseCache\Middlewares\CacheResponse;
use Symfony\Component\HttpFoundation\Response;

class CheckFlashMessageForCaching extends CacheResponse
{
  public function handle(Request $request, Closure $next, ...$args): Response
  {
    if ($request->getQueryString()) {
      return $next($request);
    }

    return parent::handle($request, $next, $args);
  }
}
