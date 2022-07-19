# Size

[![Current Version](https://img.shields.io/packagist/v/aschmelyun/size.svg?style=flat-square)](https://packagist.org/packages/aschmelyun/size)
![License](https://img.shields.io/github/license/aschmelyun/size.svg?style=flat-square)
[![Total Downloads](https://img.shields.io/packagist/dt/aschmelyun/size.svg?style=flat-square)](https://packagist.org/packages/aschmelyun/size)

:abacus: A super simple helper package for converting between different byte units.

```bash
composer require aschmelyun/size
```

## Requirements
- PHP 7.4 or higher

## Usage

Instantiate the class with the data unit you're bringing in. By default, it'll return back the value in bytes. You can then tack on either a method or a property to convert that unit into a different one.

```php
use Aschmelyun\Size\Size;

$bytesInTwoMegabytes = Size::MB(2); // 2097152

$gigabytesInTwoMegabytes = Size::MB(2)->toGB(); // 0.001953125

$kilobytesInTwoMegabytes = Size::MB(2)->KB; // 2048
```

**That's it!**

## Tests

Size comes with a small suite of tests powered by [Pest](https://pestphp.com/). To run them, clone this repository and then use:

```bash
./vendor/bin/pest
```

## Contact Info

Have an issue? Submit it here! Want to get in touch or recommend a feature? Feel free to reach out to me on [Twitter](https://twitter.com/aschmelyun) for any other questions or comments.

## License

The MIT License (MIT). See [LICENSE.md](https://github.com/aschmelyun/size/blob/main/LICENSE.md) for more details.