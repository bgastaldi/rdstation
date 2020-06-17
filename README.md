# RD Station classes for API integration

Single class to allow RDStation integration on PHP projects.

## Installation

```
composer require glauberportella/rdstation
```

## Use

```php
<?php

use RDStation\Authentication;
use RDStation\Event;

$clientId = 'Your RDStation app client id';
$clientSecret = 'Your RDStation app client secret';
$authCode = 'Code returned on callback'

$auth = new Authentication($clientId, $clientSecret);
$accessToken = $auth->getAccessToken($authCode);

$event = new Event($accessToken);
$event->conversion([
    'email' => 'leademail@email.com.br',
    'name' => 'Lead Name',
    'tags' => ['lead', 'tags']
]);

```

## TODO

- No test was done
- Need tests
- Please help improve