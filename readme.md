# Sendy API client

Formerly known as KeenDelivery.

Implementation according to the [docs](https://portal.keendelivery.com/api/v3/docs).

## Installing

```shell
composer require wedesignit/sendy-php-api-client
```

## Creating the connector

```php
$client = new \WeDesignIt\Sendy\Client($apiToken);
$sendy = new \WeDesignIt\Sendy\Sendy($client);
```

After this, the `$sendy` class can return `Endpoints` which can be called.

The endpoint methods can either be called with plain arrays or the fluent
`Resource` classes can be used.

## Further docs will follow shortly