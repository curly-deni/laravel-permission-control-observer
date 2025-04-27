<?php

namespace Aesis\PermissionObserver\Traits;

use Aesis\PermissionObserver\Observers\ActionObserver;

trait HasPermissionObserver
{
    public static function bootHasPermissionObserver()
    {
        if (app()->runningInConsole()) {
            return;
        }

        static::observe(ActionObserver::class);
    }
}
