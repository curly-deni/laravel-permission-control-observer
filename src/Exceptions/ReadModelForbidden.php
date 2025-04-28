<?php

namespace Aesis\PermissionController\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;

class ReadModelForbidden extends AuthorizationException {}
