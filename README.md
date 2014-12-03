# Growl Notifications with PHP

[![Author](http://img.shields.io/badge/author-@_beakman-blue.svg?style=flat-square)](https://twitter.com/_beakman)
[![Latest Version](https://img.shields.io/github/release/bcrowe/growl.svg?style=flat-square)](https://github.com/bcrowe/growl/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/travis/bcrowe/growl/master.svg?style=flat-square)](https://travis-ci.org/bcrowe/growl)

Growl Notifications with PHP.

## Requirements

PHP 5.3+ and one of the following notification programs:

### OS X

* [Growl](http://growl.info/downloads)
* [growlnotify](http://growl.info/downloads#generaldownloads)

... Or install `terminal-notifier`:

```bash
$ gem install terminal-notifier
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

Create a new instance of the `Growl` class and supply a `Builder` class in its
construction:

```php
<?php
use BryanCrowe\Growl\Growl;
use BryanCrowe\Growl\Builder\GrowlNotifyBuilder;
// ...
$Growl = new Growl(new GrowlNotifyBuilder());
?>
```

Then, you can chain method calls to set key/value options for a `Builder` to
use. The `Growl` class uses the `__call` magic method to set option key/value
pairs, so the method name will be the key, and it's first argument will be the
value. After setting options, the last thing to do is `execute()` your built
command:

```php
<?php
$Growl->title('Hello World')
	->message('Sup bro?! I\'m all the way turnt up!')
	->sticky(true)
	->execute();
?>
```

### Builders

There are a few available `Builder`s that come with this package...

#### BryanCrowe\Growl\Builder\GrowlNotifyBuilder

Builds commands for `growlnotify`.

Available options:

* **title** *string* The title of the growl.
* **message** *string* The growl's body.
* **sticky** *boolean* Whether or not make the growl stick until closed.

#### BryanCrowe\Growl\Builder\TerminalNotifierBuilder

Builds commands for `terminal-notifier`.

Available options:

* **title** *string* The title of the notification.
* **subtitle** *string* The notification's subtitle.
* **message** *string* The notification's body.

#### BryanCrowe\Growl\Builder\NotifySendBuilder

Builds commands for `notify-send`.

* **title** *string* The title of the notification.
* **message** *string* The notification's body.
* **sticky** *boolean* Whether or not make the notification stick until closed.

## License

The MIT License (MIT)

Copyright (c) 2014 Bryan Crowe <bryan@bryan-crowe.com>

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
