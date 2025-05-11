<?php

namespace WeDesignIt\Sendy\Endpoints\Shipment;

use GuzzleHttp\Exception\GuzzleException;
use WeDesignIt\Sendy\Endpoints\Endpoint;

class ShippingPreference extends Endpoint
{

    /**
     * Display all active shipping preferences for the active company in a list.
     *
     * @see https://app.sendy.nl/api/docs#tag/Shipping-preferences
     *
     * @return array|string
     * @throws GuzzleException
     */
    public function list(): array|string
    {
        return $this->client->request('get', 'shipping_preferences');
    }

}