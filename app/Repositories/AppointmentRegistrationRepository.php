<?php

namespace App\Repositories;

use A17\Twill\Repositories\ModuleRepository;
use App\Models\AppointmentRegistration;

class AppointmentRegistrationRepository extends ModuleRepository
{
  public function __construct(AppointmentRegistration $model)
  {
    $this->model = $model;
  }
}
