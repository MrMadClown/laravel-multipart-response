# Laravel-MultipartResponse

[![License: MIT](https://img.shields.io/badge/License-MIT-green.svg)](https://opensource.org/licenses/MIT)
[![Latest Stable Version](https://poser.pugx.org/mrmadclown/laravel-multipart-response/v/stable.svg)](https://packagist.org/packages/mrmadclown/laravel-multipart-response)
[![Total Downloads](https://poser.pugx.org/mrmadclown/laravel-multipart-response/downloads)](https://packagist.org/packages/mrmadclown/laravel-multipart-response)

## Installation

```bash
composer require mrmadclown/laravel-multipart-response
```

## Usage

If you don't use auto-discovery, add the ServiceProvider to the providers array in config/app.php

```php
MrMadClown\LaravelMultiPartResponse\ServiceProvider::class,
```

### manual Instance creation

Here for you don't actually need the ServiceProvider.

```php
use MrMadClown\LaravelMultipartResponse\Http\MultipartResponse;

$elements = [[
    'name' => 'my-file',
    'contents' => fopen('my-file.txt', 'rb'),
    'filename' => 'my-file.txt'
]];

return new MultipartResponse($elements);
```

### from Directory

This will create a Response with all the files in that directory (Not recursively!)

```php
use MrMadClown\LaravelMultipartResponse\Http\MultipartResponse;

return MultipartResponse::fromDirectory('/var/www/html/storage/app/files-to-send');
```

### with macro

This is why you would need the ServiceProvider.

```php
$elements = [[
    'name' => 'my-file',
    'contents' => fopen('my-file.txt', 'rb'),
    'filename' => 'my-file.txt'
]];

return \response()->multipart($elements);
```
