# Laravel Toolkit v1

### A Tool-Kit for Laravel Project v1

> This tollkit is contains:
> - Cache Manager Module
> - Config Manager Module
> - Console Command Module
> - Helper Module
> - Toolkit Backend Service

-------
## Requires
- [laravel/framework](https://github.com/laravel/framework/) v9.x
- [nesbot/carbon](https://github.com/nesbot/carbon/) ^v2.50

## Installation
- composer config (only if you have access)
```bash
composer config repositories.thebachtiarz/laravel-toolkit-v1 git git@github.com:thebachtiarz/laravel-toolkit-v1.git
```

- install repository
```bash
composer require thebachtiarz/laravel-toolkit-v1
```

- vendor publish
``` bash
php artisan vendor:publish --provider="TheBachtiarz\Toolkit\ServiceProvider"
```

- database migration
``` bash
php artisan migrate
```

- generate application key
``` bash
php artisan thebachtiarz:toolkit:key:generate
```

- setup caches config etc.
``` bash
php artisan thebachtiarz:toolkit:app:refresh
```

-------
## Feature

> sek males nulis cak :v
-------
