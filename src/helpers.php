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

if (! function_exists('checkModelActionAndOptionallyCallExceptionIfNotAllowed')) {
    function checkModelActionAndOptionallyCallExceptionIfNotAllowed($model, $action)
    {
        if (! config('permission-controller.'.$action.'enable', false)) {
            return true;
        }

        $status = canUserDoActionOnModel($action, $model);

        if (! $status && config('permission-controller.'.$action.'throw_exceptions', false)) {
            throw new config('permission-controller.'.$action.'exception');
        }

        return $status;
    }

}
