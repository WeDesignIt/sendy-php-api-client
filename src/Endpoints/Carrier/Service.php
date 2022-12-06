<?php

namespace WeDesignIt\Sendy\Endpoints\Carrier;

use WeDesignIt\Sendy\Endpoints\Endpoint;

class Service extends Endpoint
{

    /**
     * Display all services associated with a carrier in a list.
     * For fluent usage, you can use the WeDesignIt\Sendy\Filters\Carrier\Service
     * class for inputting filters.
     *
     * @see https://portal.keendelivery.com/api/v3/docs#tag/Services/operation/getCarrierServices
     *
     * @param int $carrierId
     * @param array $filters
     *
     * @return array|string
     * @throws GuzzleException
     */
    public function list(int $carrierId, array $filters = [])
    {
        return $this->client->request('get', 'carriers/' . $carrierId . '/services', [
            'query' => $filters,
        ]);
    }
}