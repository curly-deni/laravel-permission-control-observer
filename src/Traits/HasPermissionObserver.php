<?php

namespace Aesis\PermissionController\Traits;

use Aesis\PermissionController\Observers\ActionObserver;

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
