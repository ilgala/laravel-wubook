# laravel WuBook


Laravel WuBook was created by, and is maintained by [Filippo Galante](https://github.com/ilgala), and is a [WuBook Wired API](http://tdocs.wubook.net/wired.html) bridge for [Laravel 5](http://laravel.com). Feel free to check out the [change log](CHANGELOG.md), [releases](https://github.com/ilgala/laravel-wubook/releases), [license](LICENSE), and [contribution guidelines](CONTRIBUTING.md). In order to use the API you have to request a provider key by sending an E-Mail at devel@wubook.net, in order to connect your WuBook account, and you'll be free to try all its features. 

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

## Installation

Either [PHP](https://php.net) 5.5+ or [HHVM](http://hhvm.com) 3.6+ are required.

To get the latest version of Laravel WuBook, simply require the project using [Composer](https://getcomposer.org):

```bash
$ composer require ilgala/laravel-wubook
```

Instead, you may of course manually update your require block and run `composer update` if you so choose:

```json
{
    "require": {
        "IlGala/laravel-wubook": "0.1.0-alpha"
    }
}
```

The package uses the [fxmlrpc client](https://github.com/lstrojny/fxmlrpc) to make a call to the Wired API service. The [standard dependencies](https://github.com/lstrojny/fxmlrpc#install-dependencies) are used to create the HTTP client and message, feel free to create a pull request in order to add new features.

Once Laravel WuBook is installed, you need to register the service provider. Open up `config/app.php` and add the following to the `providers` key.

 ```php
 'providers' => [
    // OTHER PROVIDERS
    'IlGala\LaravelWubook\WuBookServiceProvider::class'
 ],
 ```

You can register the WuBook facade in the `aliases` key of your `config/app.php` file if you like.

 ```php
 'aliases' => [
    // OTHER ALIASES
    'WuBook' => IlGala\LaravelWubook\Facades\WuBook::class
 ],
 ```

## Configuration

Laravel WuBook requires connection configuration.

To get started, you'll need to publish all vendor assets:

```bash
$ php artisan vendor:publish

# OR

$ php artisan vendor:publish --provider=IlGala\LaravelWubook\WuBookServiceProvider
```

This will create a `config/wubook.php` file in your app that you can modify to set your configuration. Also, make sure you check for changes to the original config file in this package between releases.

##### Account parameters

```php
[
    'username' => 'your-user',              
    'password' => 'your-password',          
    'provider_key' => 'your-provider-key', 
    'lcode' => 'your-lcode',
]
```

The `lcode` parameter is a property ID provided by WuBook and you can find it the main control panel within the profile management section. 

The `provider_key` is released by the WuBook development team and if you need to create a new key associated with your WuBook account, please write an E-Mail at devel@wubook.net.

##### `cache_token` parameter

If `cache_token` parameter is set to true, all the API function will use a cached value and automatically renew it if necessary. If you need to retrieve the current token, call the method

```php
Cache::get('wubook.token')     // ex. '9869117656.9552'
```

The package will store also a 'wubook.token.ops' key, in order to trace the number of calls made with current token, in order to refresh it if the maximum number of operation has been reached.

**Attention:** If `cache_token` is set to false, the package will not check if the token has exceeded the maximum number of operations! 

The values stored inside the cache will expire after 3600 seconds and if the `cache_token` parameter is set to true it will be automatically renewed. Please read http://tdocs.wubook.net/wired/policies.html

## Usage

##### WuBookManager

This is the class of most interest. It is bound to the ioc container as `'wubook'` and can be accessed using the `Facades\WuBook` facade. In order to make a call to the Wired API, you may call these methods that refers to a specific area of the service. 

* `auth()`:  please read the [authentication documentation](http://tdocs.wubook.net/wired/auth.html)
* `availability()`: please read the [availabity documentation](http://tdocs.wubook.net/wired/avail.html)
* `cancellation_policies()`: please read the [cancellation policies documentation](http://tdocs.wubook.net/wired/cpolicies.html)
* `channel_manager()`: please read the [channel manager documentation](http://tdocs.wubook.net/wired/woodoo.html)
* `corporate_functions()`: please read the [corporate functions documentation](http://tdocs.wubook.net/wired/corps.html)
* `extras()`: please read the [extras documentation](http://tdocs.wubook.net/wired/extras.html)
* `prices()`: please read the [prices documentation](http://tdocs.wubook.net/wired/prices.html)
* `reservations()`: please read the reservations documentation ([fetching](http://tdocs.wubook.net/wired/fetch.html), [handling](http://tdocs.wubook.net/wired/rsrvs.html))
* `restrictions()`: please read the [restrictions documentation](http://tdocs.wubook.net/wired/rstrs.html)
* `rooms()`: please read the [rooms documentation](http://tdocs.wubook.net/wired/rooms.html)
* `transactions()`: please read the [transactions documentation](http://tdocs.wubook.net/wired/transactions.html)

##### Facades\WuBook

This facade will dynamically pass static method calls to the `'wubook'` object in the ioc container which by default is the `WuBookManager` class.

##### WuBookServiceProvider

This class contains no public methods of interest. This class should be added to the providers array in `config/app.php`. This class will setup ioc bindings.

##### WuBook API methods results

The [fxmlrpc client](https://github.com/lstrojny/fxmlrpc) always returns an associative array, that may be changed by the package in order to retrieve the resulting data from the XML/RPC function.

If an error occured during the call, a `WuBookException` will be thrown. If the call is successfully executed (see http://tdocs.wubook.net/wired/return.html) an array will be returned with this values:

```php
// An error occurred
return [
    'has_error' => true,
    'data' => 'A human readeable error message'
]

// Success
return [
    'has_error' => false,
    'data' => [ /* THE XML/RPC FUNCTION RESPONSE */ ]
]
```

Only the `WuBookAuth` API returns different values for a successful call:

```php
acquire_token()             
// returns a string (ex. '9869117656.9552'), throws an exception otherwise

release_token($token)       
// returns a boolean if the token is successfully released, throws an exception otherwise

is_token_valid($token, $request_new = false)        
// - if the token is valid returns an integer representing the total operations made with the token
// - if `request_new` is set to `true` and the token is not valid the method `aquire_token()` is called
// - false otherwise

provider_info($token = null)
// returns an array with the provider infos
```

##### Real Examples

Here you can see an example of just how simple this package is to use. Out of the box, the default `cache_token` parameter is set to false so:

```php
use IlGala\LaravelWuBook\Facades\WuBook;
// you can alias this in config/app.php if you like

// Retrieve the token
$token = WuBook::auth()->acquire_token()        // (ex. '9869117656.9552')

WuBook::rooms()->fetch_rooms(1)                 // See http://tdocs.wubook.net/wired/rooms.html#fetching-existing-rooms
// this example is simple, and there are far more methods available
// The result will be an associative array with this structure

[
    0 => [
        id => 123,
        name => 'room',
        shortname: 'ro',
        occupancy: 2,
        men: 2,
        children: 0,
        subroom: 0,
        // ...
    ],
    1 => [
        // ...
    ],
]
```

If you prefer to use dependency injection over facades like me, then you can easily inject the manager like so:

```php
use IlGala\LaravelWuBook\WuBookManager;
use Illuminate\Support\Facades\App; // you probably have this aliased already

class RoomManager
{
    protected $wubook;

    public function __construct(WuBookManager $wubook)
    {
        $this->wubook = $wubook;
    }

    public function fetch_rooms($ancillary = 0)
    {
        $this->wubook->fetch_rooms($ancillary);
    }
}

App::make('RoomManager')->fetch_rooms(1);
```

For more information on how to use the `\LaravelWubook\WuBookManager` class we are calling behind the scenes here, check out the [Wired API doc](http://tdocs.wubook.net/wired.html).

##### Further Information

There are other classes in this package that are not documented here. This is because they are not intended for public use and are used internally by this package.

## Security

If you discover a security vulnerability within this package, please send an e-mail to Filippo Galante at filippo.galante@b-ground.com. All security vulnerabilities will be promptly addressed.

## License

Laravel WuBook is licensed under [The MIT License (MIT)](LICENSE).

[ico-version]: https://img.shields.io/packagist/v/ilgala/laravel-wubook.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-style]: https://styleci.io/repos/78115500/shield?branch=master
[ico-travis]: https://img.shields.io/travis/ilgala/laravel-wubook/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/ilgala/laravel-wubook.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/ilgala/laravel-wubook.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/ilgala/laravel-wubook.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/ilgala/laravel-wubook
[link-style]: https://styleci.io/repos/78115500
[link-travis]: https://travis-ci.org/ilgala/laravel-wubook
[link-scrutinizer]: https://scrutinizer-ci.com/g/ilgala/laravel-wubook/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/ilgala/laravel-wubook
[link-downloads]: https://packagist.org/packages/ilgala/laravel-wubook
[link-author]: https://github.com/ilgala
[link-contributors]: ../../contributors
