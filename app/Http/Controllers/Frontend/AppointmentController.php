<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\DateHelper;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\AppointmentRegistration;
use App\Repositories\AppointmentRepository;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
  public function show(string $id, AppointmentRepository $eventRepository): View
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
    $event = Appointment::where('date', '>', now())->first();

    if (!$event) {
      abort(404);
    }

    SEOTools::setTitle(
      $event->title . ' - ' . DateHelper::getLocalDate($event->date)->formatLocalized('%d.%m.%Y %H:%M'),
    );

    return view('site.event', ['item' => $event]);
  }
  public function registration(string $id, AppointmentRepository $eventRepository, Request $request): RedirectResponse
  {
    /** @var \App\Models\Page $event */
    $event = $eventRepository->getById($id);

    if (!$event) {
      abort(404);
    }

    AppointmentRegistration::create([
      'name' => $request->get('name'),
      'email' => $request->get('email'),
      'appointment_id' => $id,
    ]);

    return back()
      ->with('success', 'success')
      ->withFragment('#registration_form');
  }
}
