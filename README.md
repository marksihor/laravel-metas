# laravel-metas
Laravel metas package.

## Installing

```shell
$ composer require marksihor/laravel-metas -vvv
```

### Migrations

This step is optional, if you want to customize the tables, you can publish the migration files:

```php
$ php artisan vendor:publish --provider="MarksIhor\\LaravelMetas\\MetasServiceProvider" --tag=migrations
```

## Usage

### Use the Trait on a Model you need to use it on.

#### `MarksIhor\LaravelMetas\Metable`

```php
<?php

namespace App\User;

<...>
use MarksIhor\LaravelMetas\Metable;

class User extends Authenticatable
{
    <...>
    use Metable;
    <...>
}
```

### EXAMPLES

```php

$user()->getMetas(); 
$user()->getMeta('key'); 
$user()->setMeta('key', 'value'); 
$user()->unsetMeta('key'); 
```

If you modified metas table and want to use some extra logic, you can pass additional credentials.

### EXAMPLES WITH ADDITIONAL CREDENTIALS

```php

$user()->getMetas(['site_id' => 1]); 
$user()->getMeta('key', ['site_id' => 1]); 
$user()->setMeta('key', 'value', ['site_id' => 1]); 
$user()->unsetMeta('key', ['site_id' => 1]); 
```

## License

MIT