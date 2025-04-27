<?php

namespace Aesis\PermissionObserver\Observers;

use Illuminate\Support\Facades\Gate;

class ActionObserver
{
    /**
     * Handle the "creating" event.
     */
    public function creating($model): bool
    {
        $active = canUserDoActionOnModel('create', $model);

    }

    /**
     * Handle the "updating" event.
     */
    public function updating($model): bool
    {
        return Gate::forUser(auth()->user())->allows('update', $model);
    }

    /**
     * Handle the "deleting" event.
     */
    public function deleting($model): bool
    {
        return Gate::forUser(auth()->user())->allows('delete', $model);
    }
}
