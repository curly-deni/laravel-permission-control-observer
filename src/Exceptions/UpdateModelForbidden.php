<?php

namespace Aesis\PermissionObserver\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;

class UpdateModelForbidden extends AuthorizationException {}
