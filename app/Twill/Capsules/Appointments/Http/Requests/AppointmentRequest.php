<?php

namespace App\Twill\Capsules\Appointments\Http\Requests;

use A17\Twill\Http\Requests\Admin\Request;

class AppointmentRequest extends Request
{
    public function rulesForCreate()
    {
        return [];
    }

    public function rulesForUpdate()
    {
        return [];
    }
}
