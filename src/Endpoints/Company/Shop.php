<?php

namespace WeDesignIt\Sendy\Endpoints\Company;

use WeDesignIt\Sendy\Endpoints\Endpoint;

class Shop extends Endpoint
{

    /**
     * List all shops
     *
     * @see https://portal.keendelivery.com/api/v3/docs#tag/Shops/operation/getShops
     *
     * @return array|string
     */
    public function list(): array|string
    {
        return $this->client->request('get', 'shops');
    }

    /**
     * Get a specific shop by its UUID.
     *
     * @see https://portal.keendelivery.com/api/v3/docs#tag/Shops/operation/getShops
     *
     * @param string $uuid
     *
     * @return array|string
     */
    public function get(string $uuid): array|string
    {
        return $this->client->request('get', 'shops/' . $uuid);
    }
}