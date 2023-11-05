<?php

namespace App\Repositories;

use A17\Twill\Repositories\ModuleRepository;
use App\Models\Subscription;

class SubscriptionRepository extends ModuleRepository
{
  public function __construct(Subscription $model)
  {
    $this->model = $model;
  }
}
