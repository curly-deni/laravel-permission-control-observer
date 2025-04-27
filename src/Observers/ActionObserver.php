<?php

namespace Aesis\PermissionObserver\Observers;

use Aesis\PermissionObserver\Exceptions\CreateModelForbidden;
use Aesis\PermissionObserver\Exceptions\DeleteModelForbidden;
use Aesis\PermissionObserver\Exceptions\UpdateModelForbidden;

class ActionObserver
{

    protected function check($model, $action, $exception)
    {
        $active = canUserDoActionOnModel($action, $model);

        if (! $active && config('permission-observer.throw_exceptions', false)) {
            throw new $exception();
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
