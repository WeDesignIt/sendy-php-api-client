<?php

namespace WeDesignIt\Sendy\Endpoints\Shipment;

use WeDesignIt\Sendy\Endpoints\Endpoint;

class Shipment extends Endpoint
{

    /**
     * Display all shipments in a paginated list.
     *
     * @see https://portal.keendelivery.com/api/v3/docs#tag/Shipments/operation/shipments.index
     *
     * @param array $filters
     *
     * @return array|string
     */
    public function list(array $filters = []): array|string
    {
        return $this->client->request('get', 'shipments', [
            'query' => $filters,
        ]);
    }

    /**
     * Create a new shipment.
     * For fluent usage you can use the WeDesignIt\Sendy\Resources\Shipment class for creating a shipment
     *
     * @see https://portal.keendelivery.com/api/v3/docs#tag/Shipments/operation/shipments.store
     *
     * @param array $shipment
     *
     * @return array|string
     */
    public function create(array $shipment)
    {
        return $this->client->request('post', 'shipments', [
            'json' => $shipment,
        ]);
    }

    /**
     * Get a specific shipment by its UUID.
     *
     * @see https://portal.keendelivery.com/api/v3/docs#tag/Shipments/operation/shipments.show
     *
     * @param string $uuid
     *
     * @return array|string
     */
    public function get(string $uuid): array|string
    {
        return $this->client->request('get', 'shipments/' . $uuid);
    }

    /**
     * Depending on the shipment’s status, cancel or delete the shipment.
     * When the status of the shipment is new, it will be deleted. When the shipment has been generated, it will be
     * cancelled. When the shipment has a status that does not allow deleting or cancelling, the API will return a
     * 422 response.
     *
     * @see https://portal.keendelivery.com/api/v3/docs#tag/Shipments/operation/shipments.destroy
     *
     * @param string $uuid
     *
     * @return array|string
     */
    public function cancel(string $uuid): array|string
    {
        return $this->client->request('delete', 'shipments/' . $uuid);
    }

    /**
     * Update a shipment.
     * For fluent usage you can use the WeDesignIt\Sendy\Resources\Shipment class for updating a shipment
     *
     * @see https://portal.keendelivery.com/api/v3/docs#tag/Shipments/operation/shipments.update
     *
     * @param string $uuid
     * @param array $shipment
     *
     * @return array|string
     */
    public function update(string $uuid, array $shipment): array|string
    {
        return $this->client->request('patch', 'shipments/' . $uuid, [
            'json' => $shipment,
        ]);
    }

    /**
     * Generate the label for an existing shipment.
     *
     * @see https://portal.keendelivery.com/api/v3/docs#tag/Shipments/operation/shipments.generate
     *
     * @param string $uuid UUID of the shipment
     * @param bool $asynchronous (default true) Whether the shipping label should be generated asynchronously
     *
     * @return array|string
     */
    public function generateLabel(string $uuid, bool $asynchronous = true): array|string
    {
        return $this->client->request('post', 'shipments/' . $uuid . '/generate', [
            'json' => [
                'asynchronous' => $asynchronous,
            ],
        ]);
    }
}