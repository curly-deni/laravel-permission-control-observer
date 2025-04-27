<?php

namespace Aesis\PermissionObserver\Traits;

use Aesis\PermissionObserver\Observers\ActionObserver;

trait HasPermissionObserver
{
    public static function bootHasPermissionObserver()
    {
        static::observe(ActionObserver::class);
    }
}
