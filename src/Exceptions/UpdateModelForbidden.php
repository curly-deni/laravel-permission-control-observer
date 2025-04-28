<?php

namespace Aesis\PermissionController\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;

class UpdateModelForbidden extends AuthorizationException {}
