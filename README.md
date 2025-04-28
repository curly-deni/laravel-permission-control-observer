# Laravel Permission Controller

[![Latest Version on Packagist](https://img.shields.io/packagist/v/curly-deni/laravel-permission-controller.svg?style=flat-square)](https://packagist.org/packages/curly-deni/laravel-permission-controller)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/curly-deni/laravel-permission-controller/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/curly-deni/laravel-permission-controller/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/curly-deni/laravel-permission-controller.svg?style=flat-square)](https://packagist.org/packages/curly-deni/laravel-permission-controller)

**Permission Controller** is a lightweight Laravel package that automatically enforces `create`, `update`, `delete`, and optionally `read` permissions at the model level based on your policy methods. It streamlines permission handling and improves application security with minimal setup.

---

## Features

- 🛡️ Automatic permission checks for `create`, `update`, `delete`, and optional `read` actions.
- ⚡ Seamless integration with Laravel’s native authorization system (policies).
- ⚙️ Highly configurable — control enabled actions and exception behavior per action.
- 🧩 Simple trait-based integration for Eloquent models.
- 📚 Clean, modular, and extendable architecture.

---

## Installation

Install the package via Composer:

```bash
composer require curly-deni/laravel-permission-controller
```

Publish the configuration file:

```bash
php artisan vendor:publish --tag="permission-controller-config"
```

---

## Configuration

The published configuration file `config/permission-controller.php` looks like this:

```php
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
```

**Configuration options:**

- `read_scope`: The scope class applied to model queries to restrict access based on `read` permissions.
- `observer`: The observer class that enforces permission checks on model events (`creating`, `updating`, `deleting`).

**Per-action settings (`create`, `update`, `delete`, `read`):**
- `enable`: Enable or disable permission enforcement for the specific action.
- `exception`: Exception class to throw when permission is denied (if `throw_exception` is `true`).
- `throw_exception`: If `true`, the package will throw an exception; otherwise, the action will simply not proceed.

If exceptions are enabled, these exception classes are used:

| Action  | Exception Class                                               |
|---------|---------------------------------------------------------------|
| Create  | `Aesis\PermissionController\Exceptions\CreateModelForbidden`  |
| Update  | `Aesis\PermissionController\Exceptions\UpdateModelForbidden`  |
| Delete  | `Aesis\PermissionController\Exceptions\DeleteModelForbidden`  |
| Read    | `Aesis\PermissionController\Exceptions\ReadModelForbidden`    |

> **Tip:** You can override the exception classes to provide custom messages, error codes, or even logging.

---

## Usage

### 1. Add the Trait to Your Models

Include the `HasPermissionController` trait in any Eloquent model you want to protect:

```php
use Aesis\PermissionController\Traits\HasPermissionController;

class Post extends Model
{
    use HasPermissionController;
}
```

### 2. Define Policy Methods

You must implement policy methods **only for the actions that are enabled** in the configuration:

- If `'create'` is enabled, implement a `create(User $user)` method.
- If `'update'` is enabled, implement an `update(User $user, Model $model)` method.
- If `'delete'` is enabled, implement a `delete(User $user, Model $model)` method.
- If `'read'` is enabled, implement a `read(User $user)` method (**without** passing the model instance).

Example for a `PostPolicy`:

```php
class PostPolicy
{
    public function create(User $user)
    {
        return $user->hasPermission('create-posts');
    }

    public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }

    public function delete(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }

    public function read(User $user)
    {
        return $user->hasPermission('read-posts');
    }
}
```

> **Important:**  
> The `read` method only accepts the `User` object — **no model instance** is passed.

---

## Credits

- [Danila Mikhalev](https://github.com/curly-deni)
- [All Contributors](../../contributors)

---

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
