<?php

namespace WeDesignIt\Sendy\Endpoints\Shipment;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use WeDesignIt\Sendy\Endpoints\Endpoint;
use WeDesignIt\Sendy\Resources\Shipment as ShipmentResource;

class Shipment extends Endpoint
{

    /**
     * Display all shipments in a paginated list.
     *
     * @see https://app.sendy.nl/api/docs#tag/Shipments/operation/shipments.index
     *
     * @param array $filters Only available key: 'page' for pagination
     *
     * @return array|string
     * @throws GuzzleException
     */
    public function list(array $filters = []): array|string
    {
        return $this->client->request('get', 'shipments', [
            RequestOptions::QUERY => $filters,
        ]);
    }

    /**
     * Create a new shipment.
     * For fluent usage, you can use the WeDesignIt\Sendy\Resources\Shipment class for creating a shipment
     *
     * @see https://app.sendy.nl/api/docs#tag/Shipments/operation/shipments.store
     *
     * @param array $shipment
     *
     * @return array|string
     * @throws GuzzleException
     */
    public function create(array $shipment): array|string
    {
        $requiredKeys = [
            ShipmentResource::CARRIER, ShipmentResource::SERVICE, ShipmentResource::SHOP_ID, ShipmentResource::STREET,
            ShipmentResource::CITY, ShipmentResource::COUNTRY, ShipmentResource::REFERENCE, ShipmentResource::WEIGHT,
            ShipmentResource::AMOUNT,
        ];
        if (!empty($missing = $this->getMissingRequiredKeys($requiredKeys, $shipment))) {
            throw new \InvalidArgumentException('Missing required keys in shipment data: ' . implode(', ', $missing));
        }

        return $this->client->request('post', 'shipments', [
            RequestOptions::JSON => $shipment,
        ]);
    }

    /**
     * Create a new shipment from preference.
     * @see https://app.sendy.nl/api/docs#tag/Shipments/operation/shipments.preference
     *
     * @param array $shipment
     * @param bool $asynchronous
     * @return array|string
     * @throws GuzzleException
     */
    public function createByPreference(array $shipment, bool $asynchronous = true): array|string
    {
        $requiredKeys = [
            ShipmentResource::SHOP_ID, ShipmentResource::PREFERENCE_ID, ShipmentResource::STREET, ShipmentResource::CITY,
            ShipmentResource::COUNTRY, ShipmentResource::REFERENCE, ShipmentResource::WEIGHT, ShipmentResource::AMOUNT,
        ];
        if (!empty($missing = $this->getMissingRequiredKeys($requiredKeys, $shipment))) {
            throw new \InvalidArgumentException('Missing required keys in shipment data: ' . implode(', ', $missing));
        }

        return $this->client->request('post', 'shipments', [
            RequestOptions::JSON => $shipment,
            RequestOptions::QUERY => [
                'generateDirectly' => !$asynchronous,
            ],
        ]);
    }

    /**
     * Create a new shipment from a smart rule. (has no asynchronous option)
     *
     * @see https://app.sendy.nl/api/docs#tag/Shipments/operation/shipments.smart-rule
     *
     * @param array $shipment
     * @return array|string
     * @throws GuzzleException
     */
    public function createBySmartRule(array $shipment): array|string
    {
        $requiredKeys = [
            ShipmentResource::SHOP_ID, ShipmentResource::COUNTRY
        ];
        if (!empty($missing = $this->getMissingRequiredKeys($requiredKeys, $shipment))) {
            throw new \InvalidArgumentException('Missing required keys in shipment data: ' . implode(', ', $missing));
        }

        return $this->client->request('post', 'shipments/smart-rule', [
            RequestOptions::JSON => $shipment,
        ]);
    }

    /**
     * Get a specific shipment by its UUID.
     *
     * @see https://app.sendy.nl/api/docs#tag/Shipments/operation/shipments.show
     *
     * @param string $uuid
     *
     * @return array|string
     * @throws GuzzleException
     */
    public function get(string $uuid): array|string
    {
        return $this->client->request('get', 'shipments/' . $uuid);
    }

    /**
     * Depending on the shipment’s status, cancel or delete the shipment.
     * When the status of the shipment is new, it will be deleted. When the shipment has been generated, it will be
     * canceled. When the shipment has a status that does not allow deleting or cancelling, the API will return a
     * 422 response.
     *
     * @see https://app.sendy.nl/api/docs#tag/Shipments/operation/shipments.destroy
     *
     * @param string $uuid
     *
     * @return array|string
     * @throws GuzzleException
     */
    public function cancel(string $uuid): array|string
    {
        return $this->client->request('delete', 'shipments/' . $uuid);
    }

    /**
     * Update a shipment.
     * For fluent usage, you can use the WeDesignIt\Sendy\Resources\Shipment class for updating a shipment
     *
     * @see https://app.sendy.nl/api/docs#tag/Shipments/operation/shipments.update
     *
     * @param string $uuid
     * @param array $shipment
     *
     * @return array|string
     * @throws GuzzleException
     */
    public function update(string $uuid, array $shipment): array|string
    {
        return $this->client->request('patch', 'shipments/' . $uuid, [
            RequestOptions::JSON => $shipment,
        ]);
    }

    /**
     * Generate the label for an existing shipment.
     *
     * @see https://app.sendy.nl/api/docs#tag/Shipments/operation/shipments.generate
     *
     * @param string $uuid UUID of the shipment
     * @param bool $asynchronous (default true) Whether the shipping label should be generated asynchronously
     *
     * @return array|string
     * @throws GuzzleException
     */
    public function generateLabel(string $uuid, bool $asynchronous = true): array|string
    {
        return $this->client->request('post', 'shipments/' . $uuid . '/generate', [
            RequestOptions::JSON => [
                'asynchronous' => $asynchronous,
            ],
        ]);
    }

    /**
     * Get a PDF with the export documents for a specific shipment. Also covered in Document.php (exportDocuments)
     *
     * @see https://app.sendy.nl/api/docs#tag/Documents/operation/shipments.documents
     * @param string $uuid
     * @return array|string
     * @throws GuzzleException
     */
    public function labels(string $uuid): array|string
    {
        return $this->client->request('get', 'shipments/' . $uuid . '/documents');
    }
}