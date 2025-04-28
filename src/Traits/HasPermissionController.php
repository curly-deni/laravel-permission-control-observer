<?php

namespace Aesis\PermissionController\Traits;

use Aesis\PermissionController\Observers\ActionObserver;
use Aesis\PermissionController\Scopes\ReadScope;

trait HasPermissionController
{
    public static function bootHasPermissionController()
    {
        if (! is_subclass_of(static::class, \Illuminate\Database\Eloquent\Model::class)) {
            throw new \Exception('The HasPermissionController trait can only be applied to Eloquent models.');
        }

        if (app()->runningInConsole()) {
            return;
        }

        if (
            config('permission-controller.create.enable', false) ||
            config('permission-controller.update.enable', false) ||
            config('permission-controller.delete.enable', false)
        ) {
            static::observe(config('permission-controller.observer', ActionObserver::class));
        }

        if (config('permission-controller.read.enable', false)) {
            static::addGlobalScope(new (config('permission-controller.read_scope', ReadScope::class)));
        }
    }
}
