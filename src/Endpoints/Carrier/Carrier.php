<?php

namespace WeDesignIt\Sendy\Endpoints\Carrier;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use WeDesignIt\Sendy\Endpoints\Endpoint;

/**
 * To create a shipment, you need to supply a carrier and a service. Because services can be enabled and disabled in
 * the portal, you should rely on the results of this endpoint and never hard code these values within your application.
 * The available services could change, but we highly encourage you to cache the result of this request for 24 hours.
 */
class Carrier extends Endpoint
{

    /**
     * List all carriers.
     *
     * @see https://app.sendy.nl/api/docs#tag/Carriers/operation/getCarriers
     *
     * @param array $query Possible keys for Sendy: 'product_type', 'delivery_type', 'country'
     * @return array|string
     * @throws GuzzleException
     */
    public function list(array $query = []): array|string
    {
        return $this->client->request('get', 'carriers', [
            RequestOptions::QUERY => $query,
        ]);
    }

    /**
     * Get a carrier by ID.
     *
     * @see https://app.sendy.nl/api/docs#tag/Carriers/operation/getCarrier
     *
     * @param int $id
     *
     * @return array|string
     * @throws GuzzleException
     */
    public function get(int $id): array|string
    {
        return $this->client->request('get', 'carriers/' . $id);
    }
}