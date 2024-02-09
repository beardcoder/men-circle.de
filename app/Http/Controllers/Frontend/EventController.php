<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\DateHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\EventRegisterRequest;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Services\EventRegisterService;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Contracts\View\View;
use Spatie\IcalendarGenerator\Components\Calendar;
use Spatie\IcalendarGenerator\Components\Event as CalEvent;
use Spatie\SchemaOrg\Schema;

class EventController extends Controller
{
  public function show(Event $event): View
  {
    if (!$event) {
      abort(404);
    }

    $eventSchema = $this->buildSchema($event);

    $this->setSeo($event);

    return view('site.event', ['item' => $event, 'schema' => $eventSchema]);
  }

  public function next(): View
  {
    /** @var \App\Models\Event $event */
    $event = Event::where([['startDate', '>', now()], ['published', '=', 1]])->first();

    if (!$event) {
      abort(404);
    }
    $eventSchema = $this->buildSchema($event);
    $this->setSeo($event);

    return view('site.event', ['item' => $event, 'schema' => $eventSchema]);
  }

  public function ical(Event $event)
  {
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

  private function buildSchema(Event $event)
  {
    return Schema::event()
      ->name($event->title . ' - ' . DateHelper::getLocalDate($event->startDate)->formatLocalized('%d.%m.%Y %H:%M'))
      ->description($event->description)
      ->image($event->image('event', 'desktop'))
      ->startDate($event->startDate)
      ->endDate($event->endDate)
      ->eventAttendanceMode('https://schema.org/OfflineEventAttendanceMode')
      ->eventStatus('https://schema.org/EventScheduled')
      ->location(
        Schema::place()
          ->name($event->place)
          ->address(
            Schema::postalAddress()
              ->streetAddress($event->streetAddress)
              ->addressLocality($event->addressLocality)
              ->postalCode($event->postalCode)
              ->addressCountry('DE'),
          ),
      )
      ->offers(
        Schema::offer()
          ->validFrom($event->created_at)
          ->price($event->price)
          ->availability('https://schema.org/InStock')
          ->url(url(route('events.show', $event->id)))
          ->priceCurrency('EUR'),
      )
      ->organizer(Schema::person()->name('Markus Sommer')->url('https://mens-circle.de'))
      ->performer(Schema::person()->name('Markus Sommer')->url('https://mens-circle.de'));
  }

  private function setSeo(Event $event)
  {
    SEOTools::setTitle(
      $event->title . ' - ' . DateHelper::getLocalDate($event->startDate)->formatLocalized('%d.%m.%Y %H:%M'),
    );
    SEOTools::opengraph()->addProperty('type', 'event');
  }

  protected function prepareForValidation()
  {
    $this->merge(['newsletter' => $this->has('newsletter')]);
  }

  public function register(Event $event, EventRegisterRequest $request)
  {
    EventRegistration::create([
      'name' => $request->name,
      'email' => $request->email,
      'event_id' => $event->id,
    ]);

    (new EventRegisterService(
      $event,
      $request->name,
      $request->email,
      $request->newsletter,
    ))->updateOrCreateSubscriber();

    flash('Vielen dank für deine Anmeldung.<br /> Wir freuen uns auf dich');
    return back()->setTargetUrl(back()->getTargetUrl() . '?success=true');
  }
}
