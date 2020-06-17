# RD Station classes for API integration

Single class to allow RDStation integration on PHP projects.

## Installation

```
composer require glauberportella/rdstation
```

## Use

For the current version only Event conversions can be done.

See RD Station docs for fields to pass on each event method.

(https://developers.rdstation.com/pt-BR/reference/events)[https://developers.rdstation.com/pt-BR/reference/events]

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

// Basic conversions
$event->conversion([
    'email' => 'lead@email',
    'name' => 'Lead Name',
    'tags' => ['lead', 'tags']
]);

// Opportunity
$event->opportunity([
    'funnel_name' => 'default',
    'email' => 'lead@email',
]);

// Opportunity Won (Sale)
$event->opportunityWon([
    'funnel_name' => 'default',
    'email' => 'lead@email',
    'value' => 100.50
]);

// Opportuniy lost
$event->opportunityLost([
    'funnel_name' => 'default',
    'email' => 'lead@email',
    'value' => 'lost reason',
]);

// Order placed (Ecommerce order)
$event->orderPlaced([
    'name' => 'Lead name',
    'email' => 'lead@email',
    'cf_order_id' => 'ORDER ID',
    'cf_order_payment_amount' => 200.00,
]);

// Order specific item placed
$event->orderPlacedItem([
    // ... se fieds on RD Docs
]);

// Cart abandoned
$event->cartAbandoned([
    // ... se fieds on RD Docs
]);

// Cart abandoned item
$event->cartAbandonedItem([
    // ... se fieds on RD Docs
]);

// Chat started
$event->chatStarted([
    // ... se fieds on RD Docs
]);

// Chart finished
$event->chartFinished([
    // ... se fieds on RD Docs
]);

```

## TODO

- Needs automated tests
- Add other types of resources
- Please help improve