<?php

namespace App\Twill\Capsules\Appointments\Repositories;

use A17\Twill\Repositories\ModuleRepository;
use App\Twill\Capsules\Appointments\Models\AppointmentRegistration;

class AppointmentRegistrationRepository extends ModuleRepository
{
  public function __construct(AppointmentRegistration $model)
  {
    $this->model = $model;
  }
}
