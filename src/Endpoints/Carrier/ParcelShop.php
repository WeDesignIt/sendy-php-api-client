<?php

namespace WeDesignIt\Sendy\Endpoints\Carrier;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use WeDesignIt\Sendy\Endpoints\Endpoint;

/**
 * Some services allow the shipment be delivered to a parcel shop. Use this endpoint to find a nearby parcel shop,
 * as you need to supply the ID of the parcel shop when creating a shipment with such a service.
 */
class ParcelShop extends Endpoint
{

    /**
     * Fetch a list of parcel shops near a given geolocation.
     *
     * @see https://app.sendy.nl/api/docs#tag/Parcel-shops/operation/getParcelShops
     *
     * @param array $filters Possible keys for Sendy: 'carriers', 'latitude', 'longitude', 'country', 'postal_code'
     * @return array|string
     * @throws GuzzleException
     */
    public function list(array $filters): array|string
    {
        // Check if required filters are present
        if (!isset($filters['latitude']) || !isset($filters['longitude']) || !isset($filters['country'])) {
            throw new \InvalidArgumentException('Latitude, longitude and country (iso2 code) are required to fetch parcel shops.');
        }
        return $this->client->request('get', 'parcel_shops', [
            RequestOptions::QUERY => $filters,
        ]);
    }

}