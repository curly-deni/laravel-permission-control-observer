<?php

if (! function_exists('canUserDoActionOnModel')) {
    function canUserDoActionOnModel($action, $model, $user = null)
    {

        if (is_null($user)) {
            $user = auth()->user();
        }

        return \Illuminate\Support\Facades\Gate::forUser($user)->allows($action, $model);
    }
}
