# Laravel Permission Observer

[![Latest Version on Packagist](https://img.shields.io/packagist/v/curly-deni/permission-observer.svg?style=flat-square)](https://packagist.org/packages/curly-deni/permission-observer)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/curly-deni/laravel-permission-observer/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/curly-deni/permission-observer/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/curly-deni/permission-observer.svg?style=flat-square)](https://packagist.org/packages/curly-deni/permission-observer)

Permission Observer is a lightweight Laravel package that automatically enforces create, update, and delete permissions at the model level based on your policy methods. It simplifies permission checks and ensures better security across your application.

---

## Features

- 🛡️ Automatic permission checks for `create`, `update`, and `delete` actions.
- ⚡ Easy integration with Laravel policies.
- ⚙️ Configurable behavior — optionally throw custom exceptions.
- 🧩 Simple trait-based setup for your Eloquent models.
- 📚 Clean and extendable architecture.

---

## Installation

You can install the package via Composer:

```bash
composer require curly-deni/laravel-permission-observer
```

You can publish the configuration file using:

```bash
php artisan vendor:publish --tag="permission-observer-config"
```

This will publish the following configuration:

```php
return [
    'throw_exceptions' => false,
];
```

If `throw_exceptions` is set to `true`, the package will throw specific exceptions when permission is denied:

| Action  | Exception Class |
|---------|-----------------|
| Create  | `Aesis\PermissionObserver\Exceptions\CreateModelForbidden` |
| Update  | `Aesis\PermissionObserver\Exceptions\UpdateModelForbidden` |
| Delete  | `Aesis\PermissionObserver\Exceptions\DeleteModelForbidden` |

---

## Usage

1. Add the `Aesis\PermissionObserver\Traits\HasPermissionObserver` trait to any Eloquent models you want to protect:

```php
use Aesis\PermissionObserver\Traits\HasPermissionObserver;

class Post extends Model
{
    use HasPermissionObserver;
}
```

2. Define appropriate `create`, `update`, and `delete` methods in your model's corresponding Policy class.

Example:

```php
public function update(User $user, Post $post)
{
    return $user->id === $post->user_id;
}
```

That's it! Permission Observer will automatically enforce these rules on model actions.

---

## Credits

- [Danila Mikhalev](https://github.com/curly-deni)
- [All Contributors](../../contributors)

---

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
