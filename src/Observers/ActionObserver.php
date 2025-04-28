<?php

namespace Aesis\PermissionController\Observers;

class ActionObserver
{
    /**
     * Handle the "creating" event.
     */
    public function creating($model): bool
    {
        return checkModelActionPermission($model, 'create');
    }

    /**
     * Handle the "updating" event.
     */
    public function updating($model): bool
    {
        return checkModelActionPermission($model, 'update');
    }

    /**
     * Handle the "deleting" event.
     */
    public function deleting($model): bool
    {
        return checkModelActionPermission($model, 'delete');
    }
}
