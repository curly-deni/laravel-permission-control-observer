<?php

namespace Aesis\PermissionController\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ReadScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $status = checkModelActionAndOptionallyCallExceptionIfNotAllowed($model, 'read');

        if (! $status) {
            $builder->whereRaw('1 = 0');
        }
    }
}
