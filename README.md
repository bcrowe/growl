# Growl + Notifications for PHP

Growl and notification support for PHP. Thanks to TJ Holowaychuk for inspiration
with his [Ruby Growl](http://github.com/visionmedia/growl) and
[NodeJS Growl](http://github.com/visionmedia/node-growl) libraries.

## Requirements

### OS X

* [Growl](http://growl.info/downloads)
* [growlnotify](http://growl.info/downloads#generaldownloads)

... Or install `terminal-notifier`:

	 $ sudo gem install terminal-notifier

### Linux

Install `notify-send`:

	$ sudo apt-get install libnotify-bin

### Windows

* [Growl for Windows](http://www.growlforwindows.com/gfw/default.aspx)
* [growlnotify for Windows](http://www.growlforwindows.com/gfw/help/growlnotify.aspx)

### Composer

Add this package to your `composer.json` file:

```composer
  {
    "require": {
      "bcrowe/growl": "dev-master"
    }
  }
```

## Usage

Create a new instance of the Growl class:

```php
<?php
$Growl = new \BryanCrowe\Growl();
?>
```

And use the `growl()` method to execute a growl:

```php
<?php
$Growl->growl('This is my message.', [
    'title' => 'Hello World'
]);
?>
```

The `growl()` method accepts two parameters, a `$message` string and a
`$options` array.

### Options

There are a few of available options:

* **title** The title of the growl/notification.
* **subtitle** The subtitle of the growl/notification. (terminal-notifier only)
* **sticky** Makes the growl stick until closed. (growlnotify and notify-send only)

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
