<?php

namespace App\Http\Controllers;

use App\Traits\HandlesHttpResponses;
use App\Traits\HasHelper;
use App\Traits\OTPHandler;

abstract class Controller
{
    use HandlesHttpResponses, HasHelper, OTPHandler;
}
