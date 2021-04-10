# Laravel Sanitizer

[![PHP Version](https://img.shields.io/packagist/php-v/peeyush-budhia/sanitizer?color=blue&style=for-the-badge)]()
[![LICENSE](https://img.shields.io/packagist/l/peeyush-budhia/sanitizer?color=blue&style=for-the-badge)](https://github.com/peeyush-budhia/sanitizer/blob/master/LICENSE.md)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/peeyush-budhia/sanitizer.svg?color=blue&style=for-the-badge)](https://packagist.org/packages/peeyush-budhia/sanitizer)
[![Total Downloads](https://img.shields.io/packagist/dt/peeyush-budhia/sanitizer.svg?color=blue&style=for-the-badge)](https://packagist.org/packages/peeyush-budhia/sanitizer)

[![Build Status](https://img.shields.io/travis/com/peeyush-budhia/sanitizer?style=for-the-badge)](https://travis-ci.com/peeyush-budhia/sanitizer)



Sanitization library for PHP and the Laravel framework.

## Installation

You can install the package via composer:

```sh
composer require peeyush-budhia/sanitizer
```

## Core PHP Usage

``` php
use Peeyush\Sanitizer\Sanitizer;

$data = [
    'name' => ' peeyush ',
    'birth_date' => '1987-09-10',
    'email' => 'Peeyush.Budhia@Gmail.CoM',
    'phone' => '(000)-000-00-00',
    'json' => '{"name":"Peeyush"}',
];

$filters = [
    'name' => 'trim|capitalize',
    'birth_date' => 'trim|format_date:"Y-m-d","F j, Y"',
    'email' => ['trim', 'lowercase'],
    'phone' => 'digit'
    'json' => 'cast:array',
];

$sanitizer = new Sanitizer($data, $filters);

var_dump($sanitizer);
```

Will return:

```php
[
    'name' => 'Peeyush',
    'birth_date' => 'September 10, 1987',
    'email' => 'peeyush.budhia@gmail.com',
    'phone' => '0000000000'
    'json' => ['name' => 'Peeyush'],
];
```

## Laravel Usage

- Register the `provider` and update the `alias` of Sanitizer in `config/app.php` as under:

```php
'providers' => [
        /*
         * Package Service Providers...
         */
        \Peeyush\Sanitizer\SanitizerServiceProvider::class,
    ]
```

```php
'aliases' => [
        /*
         * Package aliases...
         */
        'Sanitizer' => \Peeyush\Sanitizer\Facade\SanitizerFacade::class,
    ],
```

- Now Publish `request.stub` and `tests` directory. To publish, run the following command on terminal, in the document root of the application:

```sh
php artisan vendor:publish --provider="Peeyush\Sanitizer\SanitizerServiceProvider"
```

###### After the above process you can use Sanitizer as follows

- Use the Sanitizer through the Facade:

```php
$data = Sanitizer::make($data, $filters)->sanitize();
```

- Use SanitizeInput trait to Sanitize input in your FormRequests. Please note you need to add filters method which returns the filters you want to apply to the input.

```php
namespace App\Http\Requests;

use Peeyush\Sanitizer\SanitizeInput;

class ExampleRequest extends Request
{
    use SanitizeInput;
    
    public function filters()
    {
        return [
            'name' => 'trim|capitalize',
        ];
    }
}
```

- To auto generate the Request file run the following command on terminal, in the document root of the application:

```sh
php artisan make:Request ExampleRequest
```

## Available Filters

 Filter               | Description
:---------------------|:-------------------------
 `trim`               | Trims a string
 `escape`             | Escapes HTML and other special characters
 `lowercase`          | Converts a string to lowercase
 `uppercase`          | Converts a string to UPPERCASE
 `capitalize`         | Converts a string to Title Case
 `cast`               | Casts a variable into the given type. Options are: `int`, `float`, `string`, `bool`, `object`, `array` and Laravel Collection `collection`
 `format_date`        | Converts the date format. It takes two arguments, `first` date's given format `second` date's target format
 `strip_tags`         | Strip HTML and PHP tags
 `digit`              | Get only digit characters from a string

## Custom Filters

- Use Closure or Class that implements `Peeyush\Sanitizer\Contracts\Filter` interface:

```php
class RemoveStringFilter implements \Peeyush\Sanitizer\Contracts\Filter
{
    public function apply($value, array $options)
    {
        return str_replace($options, '', $value);
    }
}

$filters = [
    'remove_strings' => RemoveStringsFilter::class,
];

$sanitize = new Sanitizer($data, $filters)
```

## Credits

- [Peeyush Budhia](https://github.com/peeyush-budhia)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
