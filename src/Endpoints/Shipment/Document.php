<?php

namespace WeDesignIt\Sendy\Endpoints\Shipment;

use WeDesignIt\Sendy\Endpoints\Endpoint;

class Document extends Endpoint
{

    /**
     * Get a combined PDF with labels of all packages in the given shipments.
     *
     * @see https://portal.keendelivery.com/api/v3/docs#tag/Documents/operation/getLabels
     *
     * @param array $uuids UUIDs of the shipments
     *
     * @return array|string
     */
    public function multi(array $uuids): array|string
    {
        return $this->client->request('get', 'labels', [
            'query' => [
                'ids' => $uuids,
            ],
        ]);
    }


    /**
     * Get a PDF with the shipping labels for all of a shipment’s packages.
     *
     * @see https://portal.keendelivery.com/api/v3/docs#tag/Documents/operation/shipments.labels
     *
     * @param string $uuid UUID of the shipment
     *
     * @return array|string
     */
    public function get(string $uuid): array|string
    {
        return $this->client->request('get', 'shipments/' . $uuid . '/labels');
    }

    /**
     * Get a PDF with the export documents for a specific shipment.
     *
     * @see https://portal.keendelivery.com/api/v3/docs#tag/Documents/operation/shipments.documents
     *
     * @param string $uuid
     *
     * @return array|string
     */
    public function exportDocuments(string $uuid): array|string
    {
        return $this->client->request('get', 'shipments/' . $uuid . '/documents');
    }
}