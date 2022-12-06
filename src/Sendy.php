<?php

namespace WeDesignIt\Sendy;

class Sendy
{

    private Client $client;

    /**
     * ProductFlow constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }


}