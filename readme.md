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

## Directory structure / Endpoints

The Endpoint directory structure follows the documentation (category) structure for easier recognition.
The current main categories are:
- Carrier
- Shipment
- Company
  Within these categories (category folders) the actual endpoints are located.

## Usage examples

### Always: Setting up

This applies to every following example and should be prepended to every example.

```php
$client = new \WeDesignIt\Sendy\Client(
    '<your personal access token>'
);
$sendy = new \WeDesignIt\Sendy\Sendy($client);
```

### Listing your carriers
```php
$carriers = $sendy->carrier()->list();
```

### Listing a carrier's services
```php
// Retrieve carrier ID (if you haven't cached it yet)
$carriers = $sendy->carrier()->list();
// Pick the one you need. In this example we'll use the first one
if (array_key_exists('data', $carriers) && is_array($carriers['data']) && count($carriers['data']) > 0) {
    
    $carrier = $carriers['data'][0];
    $carrierId = $carrier['id'];
    
    $services = $sendy->service()->list($carrierId);
    // we could also filter the services by a couple of parameters..
    // either straight via array
    $filters = [
        \WeDesignIt\Sendy\Filters\Carrier\Service::COUNTRY => 'NL',
    ];
    // or via the fluent Filter class
    $filters = (new \WeDesignIt\Sendy\Filters\Carrier\Service())
                ->country('NL')
                ->toArray();
                
    // and use it as second parameter:
    $services = $sendy->service()->list($carrierId, $filters);            
}
```

### Locating nearby parcel shops
```php
// We will use the Filter class here too.
// Note that there's an extra advantage as your parameters will be checked in advance.
$filters = (new \WeDesignIt\Sendy\Filters\Carrier\ParcelShop())
            ->latitude(52.0792755)
            ->longitude(5.3327956)
            ->country('NL')
            ->toArray();

$parcelShops = $sendy->parcelShop()->list($filters);
```

### Listing your shops
```php
$shops = $sendy->shop()->list();
```

### Creating a shipment
```php
// get your shop ID if you haven't cached it yet
$shops = $sendy->shop()->list();
// we'll take the first one in this example
if (array_key_exists('data', $shops) && is_array($shops['data']) && count($shops['data']) > 0) {
    
    $shop = $shops['data'][0];
    $shopId = $shops['uuid'];
}
if (!isset($shopId)) {
    throw new \Exception('No shop ID given');
}
// get your carrier's value if you haven't cached it yet
$carrierInfo = $sendy->carrier()->get(8);
$carrierId = $carrierInfo['data']['id'];
$carrierValue = $carrierInfo['data']['value'];

// get your carrier's service value if you haven't cached it yet
$serviceInfo = $sendy->service()->get($carrierId, 85);
$serviceValue = $serviceInfo['data']['value'];

// now create your shipment 
$shipment = (new \WeDesignIt\Sendy\Resources\Shipment())
            ->carrier($carrierValue)
            ->service($serviceValue)
            ->shopId($shopId)
            ->reference('MS#1BOSS')
            ->companyName('Dunder Mifflin')
            ->contact('Dwight Schrute')
            ->email('assistant-regional-manager@dundermifflin.ext')
            ->street('1725 Slough Avenue')
            ->number('Suite 200')
            ->city('Pennsylvania')
            ->country('US')
            ->weight(3.14)
            ->amount(1)
            ->products([
                (new \WeDesignIt\Sendy\Resources\Shipment\Product())
                    ->description('Stapler')
                    ->netWeight(3.14)
                    ->quantity(1)
                    ->value(99.99)
            ])
            ->toArray();
            
$shipmentResponse = $sendy->shipment()->create($shipment);
```

### Retrieving a shipment label
```php
$shipmentId = $shipmentResponse['data']['uuid'];
if ($shipmentResponse['data']['has_labels'] && $shipmentResponse['data']['status'] !== 'generated'){
    // Labels weren't generated yet. Make the call to do that.
    $labelInfo = $sendy->shipment()->generateLabel($shipmentId);
    // Note this was an asychronous call, so you'll have to wait a little before making the following call
}

$label = $sendy->document()->get($shipmentId);
// The label is a base64 encoded PDF file

// Display the PDF. Of course you could also do other things with it (e.g. store it somewhere).
$pdf = base64_decode($label);
header('Content-Type: application/pdf');
echo $pdf;
```