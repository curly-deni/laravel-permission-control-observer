<?php

namespace Aesis\PermissionController\Traits;

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

        if (config('permission-controller.create.enable', false)) {
            static::creating(function ($model) {
                if (!checkModelActionAndOptionallyCallExceptionIfNotAllowed($model, 'create'))
                    return false;
            });
        }

        if (config('permission-controller.update.enable', false)) {
            static::updating(function ($model) {
                if (!checkModelActionAndOptionallyCallExceptionIfNotAllowed($model, 'update'))
                    return false;
            });
        }

        if (config('permission-controller.delete.enable', false)) {
            static::deleting(function ($model) {
                if (!checkModelActionAndOptionallyCallExceptionIfNotAllowed($model, 'delete'))
                    return false;
            });
        }

        if (config('permission-controller.read.enable', false)) {
            static::addGlobalScope(new (config('permission-controller.read_scope', ReadScope::class)));
        }
    }
}
