<?php

namespace App\Twill\Capsules\Appointments\Http\Controllers\Frontend;

use App\Helpers\DateHelper;
use App\Http\Controllers\Controller;
use App\Twill\Capsules\Appointments\Models\AppointmentRegistration;
use App\Twill\Capsules\Appointments\Repositories\AppointmentRepository;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
  public function show(string $id, AppointmentRepository $appointmentRepository): View
  {
    /** @var \App\Models\Page $appointment */
    $appointment = $appointmentRepository->getById($id);

    if (!$appointment) {
      abort(404);
    }

    SEOTools::setTitle(
      $appointment->title . ' - ' . DateHelper::getLocalDate($appointment->date)->formatLocalized('%d.%m.%Y %H:%M'),
    );

    return view('Appointments.resources.views.appointment', ['item' => $appointment]);
  }
  public function registration(
    string $id,
    AppointmentRepository $appointmentRepository,
    Request $request,
  ): RedirectResponse {
    /** @var \App\Models\Page $appointment */
    $appointment = $appointmentRepository->getById($id);

    if (!$appointment) {
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
