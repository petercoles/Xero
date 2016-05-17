# Xero API Wrapper


## Introduction

*This is a pre-alpha package* designed to provide a simple interface to the Xero API for private applications. It's not yet suitable for production use.

If you're looking for something usable now, try the [official Xero library](https://github.com/XeroAPI/XeroOAuth-PHP), [Michael Calcinai's cleaner but incomplete alternative](https://github.com/calcinai/xero-php) (it lacks reports) or my favorite, [Casper Bakker's lighweight client](https://github.com/picqer/xero-php-client) which, though very limited in functionality, has a nice UI.

But back to this package ...


## Installation

At the command line run

```
composer require petercoles/xero
```


## Usage



## Testing

The package will have two test suites. A "unit" test suite will simulate http activity (i.e. won't hit the Betfair servers), and an "integration" test suite that will test connectivity and the acceptability of requests so will need valid credentials. These should be placed in a file called .env.php in the tests/Integration folder which can be created by editing and renaming the .env.example.php file that's already there.

To run the test suites:
```
phpunit --testsuite=unit
phpunit --testsuite=integration
```

It's recommended that you only run the tests via the test suites, as some tests are deliberately excluded to avoid unintended placement of orders or moving funds around.


## Issues

This package was developed to meet a specific need and then generalised for wider use. If you have a use case not currently met, or see something that appears to not be working correctly, please raise an issue at the [github repo](https://github.com/petercoles/xero/issues).


## License

This package is licensed under the [MIT license](http://opensource.org/licenses/MIT).
