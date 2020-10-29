# :
[![License](https://img.shields.io/github/license/:tallandsassy/:plugin-grok)](https://github.com/:tallandsassy/:plugin-grok/blob/master/LICENSE.md)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/:tallandsassy/:plugin-grok.svg?style=flat-square)](https://packagist.org/packages/:tallandsassy/:plugin-grok)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/:tallandsassy/:plugin-grok/run-tests?label=tests)](https://github.com/:tallandsassy/:plugin-grok/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Coverage Status](https://coveralls.io/repos/github/:tallandsassy/:plugin-grok/badge.svg?branch=master)](https://coveralls.io/github/:tallandsassy/:plugin-grok?branch=master)

[![Total Downloads](https://img.shields.io/packagist/dt/:tallandsassy/:plugin-grok.svg?style=flat-square)](https://packagist.org/packages/:tallandsassy/:plugin-grok)


This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Support us

Please send love

## Installation
Before installing a new package it's always a good idea to clear your config cache:

```bash
php artisan config:clear
```

Then install the package with composer:

You can install the package via composer:

[ ] Make a local table for testing called 'tmp_laravel_package' (per 'phpunit.xml')

```bash
composer require tallandsassy/plugin-grok
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="TallAndSassy\PluginGrok\PluginGrokServiceProvider" --tag="migrations"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="TallAndSassy\PluginGrok\PluginGrokServiceProvider" --tag="config"
```

You can grok the routes (when .env(local)) by visiting 
    
http://test-tallandsassy.test/grok/TallAndSassy/PluginGrok/string
http://test-tallandsassy.test/grok/TallAndSassy/PluginGrok/controller

This is the contents of the published config file:

```php
return [
];
```

## Usage

``` php
$plugin-grok = new TallAndSassy\PluginGrok();
echo $plugin-grok->echoPhrase('Hello, TallAndSassy!');
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [:jjrohrer](https://github.com/:jjrohrer)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
