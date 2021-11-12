<?php

namespace App\Traits;

use App\Traits\{ErrorNotification, SuccessNotification};

trait Notification
{
    use ErrorNotification, SuccessNotification;
}