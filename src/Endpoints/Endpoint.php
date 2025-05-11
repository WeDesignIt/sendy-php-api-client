<?php

namespace WeDesignIt\Sendy\Endpoints;

use WeDesignIt\Sendy\Client;

abstract class Endpoint
{

    protected Client $client;

    /**
     * Resource constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function containsRequiredKeys(array $required, array $data): bool
    {
        return empty($this->getMissingRequiredKeys($required, $data));
    }

    public function getMissingRequiredKeys(array $required, array $data): array
    {
        return array_keys(array_diff_key(array_flip($required), $data));
    }

}
