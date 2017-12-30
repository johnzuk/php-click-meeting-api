A PHP [ClickMeeting API](https://dev.clickmeeting.com/api-doc/) wrapper
==============

Requirements
------------

* PHP >= 5.6
* [Guzzle](https://github.com/guzzle/guzzle) library,
* (optional) PHPUnit to run tests.

Installation
------------
Via [composer](https://getcomposer.org)

```bash
composer require johnzuk/php-click-meeting-api php-http/guzzle6-adapter
```


General API Usage
-----------------

```php
<?php

// This file is generated by Composer
require_once __DIR__ . '/vendor/autoload.php';

$client = new \ClickMeeting\Client();
$client->authenticate('YourAPIKeyHere');

$client->registrations()->all(123123);
$client->conferences()->delete(321321);
```