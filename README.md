# Growl Notifications with PHP

[![Author](http://img.shields.io/badge/author-@_beakman-blue.svg?style=flat-square)](https://twitter.com/_beakman)
[![Latest Version](https://img.shields.io/github/release/bcrowe/growl.svg?style=flat-square)](https://github.com/bcrowe/growl/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/travis/bcrowe/growl/master.svg?style=flat-square)](https://travis-ci.org/bcrowe/growl)
[![Code Coverage](https://img.shields.io/coveralls/bcrowe/growl.svg?style=flat-square)](https://coveralls.io/r/bcrowe/growl)
[![Total Downloads](https://img.shields.io/packagist/dt/bcrowe/growl.svg?style=flat-square)](https://packagist.org/packages/bcrowe/growl)

This package aims to provide an easy and fluent interface to construct and
execute commands for various desktop notification programs.

## Requirements

PHP 5.4+ and one of the following notification programs:

### OS X

* [Growl](http://growl.info/downloads)
* [growlnotify](http://growl.info/downloads#generaldownloads)

... Or install the `terminal-notifier` gem:

```bash
$ gem install terminal-notifier
```
or...
```bash
$ brew install terminal-notifier
```

### Linux

Install `notify-send`.

#### Debian/Ubuntu

``` bash
$ apt-get install libnotify-bin
```

#### RedHat/Fedora

``` bash
$ yum install libnotify
```

### Windows

* [Growl for Windows](http://www.growlforwindows.com/gfw/default.aspx)
* [growlnotify for Windows](http://www.growlforwindows.com/gfw/help/growlnotify.aspx)

## Installation

### Composer

``` bash
$ composer require bcrowe/growl
```

## Usage

Create a new instance of the `Growl` class. You can optionally supply a
`Builder` class and/or its path if you don't wish for the package to choose
a `Builder` for you:

```php
<?php
use BryanCrowe\Growl\Growl;
// ...
$Growl = new Growl;
?>
```

Or...

```php
<?php
use BryanCrowe\Growl\Growl;
use BryanCrowe\Growl\Builder\GrowlNotifyBuilder;
// ...
$Growl = new Growl(new GrowlNotifyBuilder('/usr/local/bin/growlnotify'));
?>
```

Then, you can set key/value options for a `Builder` to use with the `Growl`
class' `setOption()` or `setOptions()` methods to set option key/value pairs.
After setting options, the last thing to do is build the command with
`buildCommand()` or run it with `execute()`:

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
disable escaping, or provide a list of safe option keys that will be bypassed
while escaping is enabled.

```php
<?php
// Completely disable escaping...
$Growl->setOptions([
        'title' => 'Hello World',
        'subtitle' => 'Earth',
        'message' => 'How are you doing?',
        'url' => 'http://www.google.com'
    ])
    ->setEscape(false)
    ->execute();

// Set a safe list of option keys. Can be an array of option keys, or a string.
$Growl->setOptions([
        'title' => 'Hello World',
        'subtitle' => $safeSubtitle,
        'message' => 'How are you doing?',
        'url' => $safeURL
    ])
    ->setSafe(['subtitle', 'open'])
    ->execute();
?>
```

### Builders

There are a few available `Builder`s that come with this package...

#### GrowlNotifyBuilder & GrowlNotifyWindowsBuilder

Builds commands for `growlnotify`.

Available option keys:

* **title** *string* The title of the growl.
* **message** *string* The growl's body.
* **sticky** *boolean* Whether or not make the growl stick until closed.
* **image** *string* A name of an application's icon to use, e.g., "Mail"
(Darwin), the path to a file on the system (Darwin & Windows), or a URL to an
image (Windows).
* **url** *string* A URL to open if the growl is clicked.

#### TerminalNotifierBuilder

Builds commands for `terminal-notifier`.

Available option keys:

* **title** *string* The title of the notification.
* **subtitle** *string* The notification's subtitle.
* **message** *string* The notification's body.
* **image** *string* A URL to an image to be used as the icon. *(Mavericks+ only)*
* **contentImage** *string* A URL to an image to be in the notification body. *(Mavericks+ only)*
* **open** *string* A URL to go to when the notification is clicked.

#### NotifySendBuilder

Builds commands for `notify-send`.

Available option keys:

* **title** *string* The title of the notification.
* **message** *string* The notification's body.
* **sticky** *boolean* Whether or not make the notification stick until closed.

## License

The MIT License (MIT)

Copyright (c) 2015 Bryan Crowe <bryan@bryan-crowe.com>

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
