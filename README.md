# Growl Notifications with PHP

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

This package aims to provide an easy and fluent interface to construct and
execute commands for various desktop notification programs.

## Requirements

PHP 5.4+ and one of the following notification programs:

### OS X

#### Growl & GrowlNotify

* [Growl](http://growl.info/downloads)
* [GrowlNotify](http://growl.info/downloads#generaldownloads)

#### terminal-notifier

```bash
$ gem install terminal-notifier
$ brew install terminal-notifier
```

### Linux

#### notify-send

``` bash
$ apt-get install libnotify-bin
$ yum install libnotify
```

### Windows

#### Growl & GrowlNotify

* [Growl](http://www.growlforwindows.com/gfw/default.aspx)
* [GrowlNotify](http://www.growlforwindows.com/gfw/help/growlnotify.aspx)

## Installation

### Composer

``` bash
$ composer require bcrowe/growl
```

## Usage

Create a new instance of the `Growl` class. You can optionally supply a
`Builder` class and its path if you don't wish for the package to choose
a notification program based on your system:

```php
<?php
use BryanCrowe\Growl\Growl;

$Growl = new Growl;

// Or...

use BryanCrowe\Growl\Growl;
use BryanCrowe\Growl\Builder\GrowlNotifyBuilder;

$Growl = new Growl(new GrowlNotifyBuilder('/usr/local/bin/growlnotify'));
?>
```

Now, you can set key/value options for a `Builder` to use with the `setOption()`
or `setOptions()` methods. After setting options, the last thing to do is build
the command with `buildCommand()` or run it with `execute()`:

```php
<?php
(new Growl)
    ->setOption('title', 'Hello World')
    ->setOption('message', 'How are you doing?')
    ->setOption('sticky', true)
    ->execute();

// Or...

$Growl = new Growl;
$Growl->setOptions([
        'title' => 'Hello World',
        'message' => 'How are you doing?',
        'sticky' => true
    ])
    ->buildCommand();

exec($Growl);
?>
```

By default, this package will escape all command arguments that are supplied as
options. If you want to change this, there are two options. Either completely
disable escaping, or provide a safe-list of option keys that will be bypassed
while escaping is enabled.

```php
<?php
// Completely disable escaping...
(new Growl)
    ->setOptions([
        'title' => 'Hello World',
        'message' => 'How are you doing?',
        'url' => 'http://www.google.com'
    ])
    ->setEscape(false)
    ->execute();

// Set a safe-list of option keys. Can be an array of option keys, or a string.
(new Growl)
    ->setOptions([
        'title' => 'Hello World',
        'message' => $mySafeMessage,
        'url' => $mySafeURL
    ])
    ->setSafe(['message', 'url'])
    ->execute();
?>
```

### Builders

#### GrowlNotifyBuilder & GrowlNotifyWindowsBuilder

Builds commands for `growlnotify`.

Available option keys:

* **title** *string* The title of the growl.
* **message** *string* The growl's body.
* **sticky** *boolean* Whether or not make the growl stick until closed.
* **image** *string* A name of an application's icon to use, e.g., "Mail"
*(OS X only)*, the path to a file on the system *(OS X & Windows)*, or a URL to
an image *(Windows only)*.
* **url** *string* A URL to open if the growl is clicked.

#### TerminalNotifierBuilder

Builds commands for `terminal-notifier`.

Available option keys:

* **title** *string* The title of the notification.
* **subtitle** *string* The notification's subtitle.
* **message** *string* The notification's body.
* **image** *string* A URL to an image to be used as the icon. *(OS X Mavericks+ only)*
* **contentImage** *string* A URL to an image to be in the notification body. *(OS X Mavericks+ only)*
* **url** *string* A URL to go to when the notification is clicked.

#### NotifySendBuilder

Builds commands for `notify-send`.

Available option keys:

* **title** *string* The title of the notification.
* **message** *string* The notification's body.
* **sticky** *boolean* Whether or not make the notification stick until closed.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email bryan@bryan-crowe.com instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/bcrowe/growl.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/bcrowe/growl/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/bcrowe/growl.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/bcrowe/growl.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/bcrowe/growl.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/bcrowe/growl
[link-travis]: https://travis-ci.org/bcrowe/growl
[link-scrutinizer]: https://scrutinizer-ci.com/g/bcrowe/growl/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/bcrowe/growl
[link-downloads]: https://packagist.org/packages/bcrowe/growl
[link-author]: https://github.com/bcrowe
[link-contributors]: ../../contributors
