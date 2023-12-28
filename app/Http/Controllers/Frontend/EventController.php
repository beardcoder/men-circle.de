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
    $event = Event::where('date', '>', now())->first();

    if (!$event) {
      abort(404);
    }

    $this->setJsonLD($event);

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

  private function setJsonLD(Event $event)
  {
    SEOTools::setTitle(
      $event->title . ' - ' . DateHelper::getLocalDate($event->date)->formatLocalized('%d.%m.%Y %H:%M'),
    );
    SEOTools::opengraph()->addProperty('type', 'event');
    SEOTools::jsonLd()->setType('Event');
    SEOTools::jsonLd()->addValues([
      'startDate' => $event->date,
      'eventAttendanceMode' => 'https://schema.org/OfflineEventAttendanceMode',
      'eventStatus' => 'https://schema.org/EventScheduled',
      'location' => [
        '@type' => 'Place',
        'name' => 'Hier&Jetzt Yogastudio - Straubing',
        'address' => [
          '@type' => 'PostalAddress',
          'streetAddress' => 'Fraunhoferstraße 13',
          'addressLocality' => 'Straubing',
          'postalCode' => '94315',
          'addressCountry' => 'DE',
        ],
      ],
      'description' =>
        'Ein Raum für offene Kommunikation, Weisheit, Unterstützung, Spannungslinderung, Akzeptanz, Verständnis, Vertrauen und Anerkennung. Geschichten und Erfahrungen teilen in einer unterstützenden Männergruppe.',
      'offers' => [
        '@type' => 'Offer',
        'price' => '0',
        'priceCurrency' => 'EUR',
        'description' => 'Kostenlos / Spendenbasis',
      ],
      'organizer' => [
        '@type' => 'Person',
        'name' => 'Markus Sommer',
        'url' => 'https://mens-circle.de',
      ],
    ]);
  }
}
