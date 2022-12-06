<?php

namespace WeDesignIt\Sendy\Endpoints\Company;

use WeDesignIt\Sendy\Endpoints\Endpoint;

class User extends Endpoint
{

    /**
     * Display the currently authenticated user's profile.
     *
     * @see https://portal.keendelivery.com/api/v3/docs#tag/User/operation/getProfileInformation
     *
     * @return array|string
     */
    public function list(): array|string
    {
        return $this->client->request('get', 'me');
    }

}