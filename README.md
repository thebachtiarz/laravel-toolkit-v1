# Laravel Toolkit v1

### A Tool-Kit for Laravel Project v1

> This tollkit is contains:
> - Cache Manager Module
> - Config Manager Module
> - Console Command Module
> - Helper Module
> - Toolkit Backend Service

-------

## Installation
- composer config (only if you have access)
```bash
composer config repositories.thebachtiarz/laravel-toolkit-v1 git git@github.com:thebachtiarz/laravel-toolkit-v1.git
```

- install repository
```bash
Laravel 9:
composer require thebachtiarz/laravel-toolkit-v1:^2.0

Laravel 8:
composer require thebachtiarz/laravel-toolkit-v1:^1.1
```

- vendor publish
``` bash
php artisan vendor:publish --provider="TheBachtiarz\Toolkit\ToolkitServiceProvider"
```

- database migration
``` bash
php artisan migrate
```

- register the REST API into -> **app/Providers/RouteServiceProvider.php**
```bash
Route::prefix(tbtoolkitconfig('app_prefix'))
    ->middleware(['api'])
    ->namespace($this->namespace)
    ->group(tbtoolkitrouteapi());
```

-------
## Feature

> sek males nulis cak :v
-------
