<?php

namespace WeDesignIt\Sendy\Endpoints\Company;

use GuzzleHttp\Exception\GuzzleException;
use WeDesignIt\Sendy\Endpoints\Endpoint;

class Shop extends Endpoint
{

    /**
     * List all shops
     *
     * @see https://app.sendy.nl/api/docs#tag/Shops/operation/getShops
     *
     * @return array|string
     * @throws GuzzleException
     */
    public function list(): array|string
    {
        return $this->client->request('get', 'shops');
    }

    /**
     * Get a specific shop by its UUID.
     *
     * @see https://app.sendy.nl/api/docs#tag/Shops/operation/getShopByUuid
     *
     * @param string $uuid
     *
     * @return array|string
     * @throws GuzzleException
     */
    public function get(string $uuid): array|string
    {
        return $this->client->request('get', 'shops/' . $uuid);
    }
}