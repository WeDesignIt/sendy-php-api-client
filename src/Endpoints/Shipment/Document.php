<?php

namespace WeDesignIt\Sendy\Endpoints\Shipment;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use WeDesignIt\Sendy\Endpoints\Endpoint;

class Document extends Endpoint
{

    /**
     * Get a combined PDF with labels of all packages in the given shipments.
     *
     * @see https://app.sendy.nl/api/docs#tag/Documents/operation/getLabels
     *
     * @param array $uuids UUIDs of the shipments
     * @param array $options Possible keys for Sendy: 'paper_type', 'start_location'
     *
     * @return array|string
     * @throws GuzzleException
     */
    public function multi(array $uuids, array $options = []): array|string
    {
        $options['ids'] = $uuids;
        return $this->client->request('get', 'labels', [
            RequestOptions::QUERY => $options,
        ]);
    }


    /**
     * Get a PDF with the shipping labels for all of a shipment’s packages.
     *
     * @see https://app.sendy.nl/api/docs#tag/Documents/operation/shipments.labels
     *
     * @param string $uuid UUID of the shipment
     * @param array $options Possible keys for Sendy: 'paper_type', 'start_location'
     *
     * @return array|string
     * @throws GuzzleException
     */
    public function get(string $uuid, array $options = []): array|string
    {
        return $this->client->request('get', 'shipments/' . $uuid . '/labels', [
            RequestOptions::QUERY => $options,
        ]);
    }

    /**
     * Get a PDF with the export documents for a specific shipment.
     *
     * @see https://app.sendy.nl/api/docs#tag/Documents/operation/shipments.documents
     *
     * @param string $uuid
     *
     * @return array|string
     * @throws GuzzleException
     */
    public function exportDocuments(string $uuid): array|string
    {
        return $this->client->request('get', 'shipments/' . $uuid . '/documents');
    }
}