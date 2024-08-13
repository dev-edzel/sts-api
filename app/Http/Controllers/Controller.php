<?php

namespace App\Http\Controllers;

use App\Traits\HandlesHttpResponses;
use App\Traits\HasHelper;

abstract class Controller
{
    use HandlesHttpResponses, HasHelper;
}
