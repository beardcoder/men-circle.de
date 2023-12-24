<?php

namespace App\Repositories;

use A17\Twill\Repositories\ModuleRepository;
use App\Models\EventRegistration;

class EventRegistrationRepository extends ModuleRepository
{
  public function __construct(EventRegistration $model)
  {
    $this->model = $model;
  }
}
