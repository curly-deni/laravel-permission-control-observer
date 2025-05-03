<?php

namespace Aesis\PermissionController\Observers;

class ActionObserver
{
    /**
     * Handle the "creating" event.
     */
    public function creating($model): bool
    {
        return checkModelActionAndOptionallyCallExceptionIfNotAllowed($model, 'create');
    }

    /**
     * Handle the "updating" event.
     */
    public function updating($model): bool
    {
        return checkModelActionAndOptionallyCallExceptionIfNotAllowed($model, 'update');
    }

    /**
     * Handle the "deleting" event.
     */
    public function deleting($model): bool
    {
        return checkModelActionAndOptionallyCallExceptionIfNotAllowed($model, 'delete');
    }
}
