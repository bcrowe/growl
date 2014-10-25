# Growl and Notifications for PHP and Monolog

[![Author](http://img.shields.io/badge/author-@_beakman-blue.svg?style=flat-square)](https://twitter.com/_beakman)
[![Latest Version](https://img.shields.io/github/release/bcrowe/growl.svg?style=flat-square)](https://github.com/bcrowe/growl/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/travis/bcrowe/growl/master.svg?style=flat-square)](https://travis-ci.org/bcrowe/growl)

Growl support for PHP. With
[Monolog support](https://github.com/bcrowe/growl#monolog-handler). Thanks to TJ
Holowaychuk for inspiration with his
[Ruby Growl](http://github.com/visionmedia/growl) and
[NodeJS Growl](http://github.com/visionmedia/node-growl) libraries.

## Requirements

PHP 5.4+ and one of the following notification programs:

### OS X

* [Growl](http://growl.info/downloads)
* [growlnotify](http://growl.info/downloads#generaldownloads)

... Or install `terminal-notifier`:

	 $ gem install terminal-notifier

### Linux

Install `notify-send`.

#### Debian/Ubuntu

	$ apt-get install libnotify-bin

#### RedHat/Fedora

  $ yum install libnotify

### Windows

* [Growl for Windows](http://www.growlforwindows.com/gfw/default.aspx)
* [growlnotify for Windows](http://www.growlforwindows.com/gfw/help/growlnotify.aspx)

## Installation

### Composer

  $ composer require bcrowe/growl

## Usage

Create a new instance of the Growl class:

```php
<?php
$Growl = new \BryanCrowe\Growl\Growl();
?>
```

... and use the `growl()` method to execute a growl. The `growl()` method
accepts two parameters, a `$message` string and an `$options` array:

```php
<?php
$Growl->growl('This is my message.', [
    'title' => 'Hello World'
]);
?>
```

### Options

There are a few of available keys for the `$options` array:

* **title** The title of the growl.
* **subtitle** The subtitle of the growl. (*terminal-notifier only*)
* **sticky** Makes the growl persist until closed. (*growlnotify and notify-send only*)

An example using all options:

```php
<?php
$Growl->growl('This is my message.', [
    'title' => 'Hello World',
    'subtitle' => 'Earth',
    'sticky' => true
]);
?>
```

### Monolog Handler

Include [monolog](https://github.com/Seldaek/monolog) in your project and:

```php
<?php
use BryanCrowe\Monolog\Handler\GrowlHandler;
use Monolog\Logger;
// ...
$log = new Logger('name');
$log->pushHandler(new GrowlHandler());
?>
```

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
