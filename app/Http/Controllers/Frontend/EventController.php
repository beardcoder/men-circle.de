<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\DateHelper;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Repositories\EventRepository;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EventController extends Controller
{
  public function show(string $id, EventRepository $eventRepository): View
  {
    /** @var \App\Models\Page $event */
    $event = $eventRepository->getById($id);
    if (!$event) {
      abort(404);
    }

    SEOTools::setTitle(
      $event->title . ' - ' . DateHelper::getLocalDate($event->date)->formatLocalized('%d.%m.%Y %H:%M'),
    );

    return view('site.event', ['item' => $event]);
  }

  public function next(): View
  {
    /** @var \App\Models\Page $event */
    $event = Event::where('date', '>', now())->first();

    if (!$event) {
      abort(404);
    }

    SEOTools::setTitle(
      $event->title . ' - ' . DateHelper::getLocalDate($event->date)->formatLocalized('%d.%m.%Y %H:%M'),
    );

    return view('site.event', ['item' => $event]);
  }
  public function registration(string $id, EventRepository $eventRepository, Request $request): RedirectResponse
  {
    /** @var \App\Models\Page $event */
    $event = $eventRepository->getById($id);

    if (!$event) {
      abort(404);
    }

    EventRegistration::create([
      'name' => $request->get('name'),
      'email' => $request->get('email'),
      'event_id' => $id,
    ]);

    return back()
      ->with('success', 'success')
      ->withFragment('#registration_form');
  }
}
