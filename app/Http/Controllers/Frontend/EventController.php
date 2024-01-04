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
use Response;
use Spatie\IcalendarGenerator\Components\Calendar;
use Spatie\IcalendarGenerator\Components\Event as CalEvent;
use Spatie\IcalendarGenerator\Enums\Display;

class EventController extends Controller
{
  public function show(string $id, EventRepository $eventRepository): View
  {
    /** @var \App\Models\Event $event */
    $event = $eventRepository->getById($id);
    if (!$event) {
      abort(404);
    }

    $this->setJsonLD($event);

    return view('site.event', ['item' => $event]);
  }

  public function next(): View
  {
    /** @var \App\Models\Event $event */
    $event = Event::where([['startDate', '>', now()], ['published', '=', 1]])->first();

    if (!$event) {
      abort(404);
    }

    $this->setJsonLD($event);

    return view('site.event', ['item' => $event]);
  }
  public function ical(string $id, EventRepository $eventRepository, Request $request)
  {
    /** @var \App\Models\Page $event */
    $event = $eventRepository->getById($id);
    if (!$event) {
      abort(404);
    }

    $calEvent = CalEvent::create()
      ->name($event->title . ' - ' . DateHelper::getLocalDate($event->startDate)->formatLocalized('%d.%m.%Y %H:%M'))
      ->description($event->description)
      ->startsAt(DateHelper::getLocalDate($event->startDate)->toDate())
      ->endsAt(DateHelper::getLocalDate($event->endDate)->toDate())
      ->address($event->streetAddress . ', ' . $event->postalCode . ' ' . $event->addressLocality)
      ->addressName($event->place)
      ->coordinates($event->latitude, $event->longitude)
      ->image('https://mens-circle.de/assets/web/images/logo.png')
      ->organizer('markus@letsbenow.de', 'Markus Sommer');

    $calendar = Calendar::create(
      $event->title . ' - ' . DateHelper::getLocalDate($event->startDate)->formatLocalized('%d.%m.%Y %H:%M'),
    )->event($calEvent);

    return response($calendar->get(), 200, [
      'Content-Type' => 'text/calendar; charset=utf-8',
      'Content-Disposition' => 'attachment; filename="calendar.ics"',
    ]);
  }

  private function setJsonLD(Event $event)
  {
    SEOTools::setTitle(
      $event->title . ' - ' . DateHelper::getLocalDate($event->startDate)->formatLocalized('%d.%m.%Y %H:%M'),
    );
    SEOTools::opengraph()->addProperty('type', 'event');
    SEOTools::jsonLd()->setType('Event');
    SEOTools::jsonLd()->addValues([
      'startDate' => $event->startDate,
      'endDate' => $event->endDate,
      'eventAttendanceMode' => 'https://schema.org/OfflineEventAttendanceMode',
      'eventStatus' => 'https://schema.org/EventScheduled',
      'location' => [
        '@type' => 'Place',
        'name' => $event->place,
        'address' => [
          '@type' => 'PostalAddress',
          'streetAddress' => $event->streetAddress,
          'addressLocality' => $event->addressLocality,
          'postalCode' => $event->postalCode,
          'addressCountry' => 'DE',
        ],
      ],
      'description' => $event->description,
      'offers' => [
        '@type' => 'Offer',
        'price' => $event->price,
        'availability' => 'https://schema.org/InStock',
        'url' => url(route('events.show', $event->id)),
        'priceCurrency' => 'EUR',
      ],
      'organizer' => [
        '@type' => 'Person',
        'name' => 'Markus Sommer',
        'url' => 'https://mens-circle.de',
      ],
      'performer' => [
        '@type' => 'Person',
        'name' => 'Markus Sommer',
        'url' => 'https://mens-circle.de',
      ],
    ]);
  }
}
