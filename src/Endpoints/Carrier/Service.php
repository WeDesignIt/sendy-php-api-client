<?php

namespace WeDesignIt\Sendy\Endpoints\Carrier;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use WeDesignIt\Sendy\Endpoints\Endpoint;

class Service extends Endpoint
{

    /**
     * Display all services associated with a carrier in a list.
     * For fluent usage, you can use the WeDesignIt\Sendy\Filters\Carrier\Service
     * class for inputting filters.
     *
     * @see https://app.sendy.nl/api/docs#tag/Services/operation/getCarrierServices
     *
     * @param int $carrierId
     * @param array $filters Possible keys for Sendy: 'country', 'delivery_type', 'product_type'
     *
     * @return array|string
     * @throws GuzzleException
     */
    public function list(int $carrierId, array $filters = []): array|string
    {
        return $this->client->request('get', 'carriers/' . $carrierId . '/services', [
            RequestOptions::QUERY => $filters,
        ]);
    }
}