<?php

namespace WeDesignIt\Sendy\Endpoints\Company;

use GuzzleHttp\Exception\GuzzleException;
use WeDesignIt\Sendy\Endpoints\Endpoint;

class User extends Endpoint
{

    /**
     * Display the currently authenticated user's profile.
     *
     * @see https://app.sendy.nl/api/docs#tag/User/operation/getProfileInformation
     *
     * @return array|string
     * @throws GuzzleException
     */
    public function list(): array|string
    {
        return $this->client->request('get', 'me');
    }

}