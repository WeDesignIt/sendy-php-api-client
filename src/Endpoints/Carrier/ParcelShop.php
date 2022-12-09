<?php

namespace WeDesignIt\Sendy\Endpoints\Carrier;

use WeDesignIt\Sendy\Endpoints\Endpoint;

/**
 * Some services allow the shipment be delivered to a parcel shop. Use this endpoint to find a nearby parcel shop,
 * as you need to supply the ID of the parcel shop when creating a shipment with such a service.
 */
class ParcelShop extends Endpoint
{

    /**
     * Fetch a list of parcel shops near a given geo location.
     *
     * @see https://portal.keendelivery.com/api/v3/docs#tag/Parcel-Shops/operation/getParcelShops
     *
     * @return array|string
     */
    public function list(array $filters = []): array|string
    {
        return $this->client->request('get', 'parcel_shops', [
            'query' => $filters,
        ]);
    }

}