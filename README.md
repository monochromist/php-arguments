# PHP-Arguments

PHP-Arguments is an utility class for arguments validation code.
Nothing special here, just some utility methods for libraries that need to enforce arguments validation
and provide better error messages to developers using a library.

## Example

```php
use monochromist/Arguments;
...
public function doSomething($arg1, $arg2, $arg3, $arg4) {
  // string or boolean required
  Arguments::validate($arg1, ['string', 'boolean'];
  // integer required
  Arguments::validate($arg2, ['integer']);
  // not null required
  Arguments::notNull($arg3);
  // check if $arg4 is a string=>any associative array
  Arguments::validateAssociativeArray($arg4);
}
```
## Setup

PHP-Arguments uses [Composer](https://getcomposer.org/) as dependency manager.

`$ composer install`

You may also generate documentation:

`$ ./bin/phpdoc -d ./src/ -t ./docs/`

## Testing

`$ ./bin/phpunit`

## Contribute

Simply fork, code your tests and modifications, write a good commit message and submit a pull request.
All tests must pass and the coverage must remains at 100%.

# References

[PHP the right way](http://www.phptherightway.com)
