<?php

namespace Aesis\PermissionController\Observers;

use Aesis\PermissionController\Exceptions\CreateModelForbidden;
use Aesis\PermissionController\Exceptions\DeleteModelForbidden;
use Aesis\PermissionController\Exceptions\UpdateModelForbidden;

class ActionObserver
{
    protected function check($model, $action, $exception)
    {
        $active = canUserDoActionOnModel($action, $model);

        if (! $active && config('permission-controller.throw_exceptions', false)) {
            throw new $exception;
        }

        return $active;
    }

    /**
     * Handle the "creating" event.
     */
    public function creating($model): bool
    {
        return $this->check($model, 'create', CreateModelForbidden::class);
    }

    /**
     * Handle the "updating" event.
     */
    public function updating($model): bool
    {
        return $this->check($model, 'update', UpdateModelForbidden::class);
    }

    /**
     * Handle the "deleting" event.
     */
    public function deleting($model): bool
    {
        return $this->check($model, 'delete', DeleteModelForbidden::class);
    }
}
