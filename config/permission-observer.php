<?php

return [
    'read_scope' => \Aesis\PermissionController\Scopes\ReadScope::class,
    'observer' => \Aesis\PermissionController\Observers\ActionObserver::class,

    'create' => [
        'enable' => true,
        'exception' => \Aesis\PermissionController\Exceptions\CreateModelForbidden::class,
        'throw_exception' => false,
    ],

    'update' => [
        'enable' => true,
        'exception' => \Aesis\PermissionController\Exceptions\UpdateModelForbidden::class,
        'throw_exception' => false,
    ],

    'delete' => [
        'enable' => true,
        'exception' => \Aesis\PermissionController\Exceptions\DeleteModelForbidden::class,
        'throw_exception' => false,
    ],

    'read' => [
        'enable' => false,
        'exception' => \Aesis\PermissionController\Exceptions\ReadModelForbidden::class,
        'throw_exception' => false,
    ],
];
