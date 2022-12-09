<?php

namespace WeDesignIt\Sendy;

use WeDesignIt\Sendy\Endpoints\Carrier\Carrier;
use WeDesignIt\Sendy\Endpoints\Carrier\ParcelShop;
use WeDesignIt\Sendy\Endpoints\Carrier\Service;
use WeDesignIt\Sendy\Endpoints\Company\Shop;
use WeDesignIt\Sendy\Endpoints\Company\User;
use WeDesignIt\Sendy\Endpoints\Shipment\Document;
use WeDesignIt\Sendy\Endpoints\Shipment\Shipment;

class Sendy
{

    private Client $client;

    /**
     * Sendy constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return Carrier
     */
    public function carrier(): Carrier
    {
        return new Carrier($this->client);
    }

    /**
     * @return ParcelShop
     */
    public function parcelShop(): ParcelShop
    {
        return new ParcelShop($this->client);
    }

    /**
     * @return Service
     */
    public function Service(): Service
    {
        return new Service($this->client);
    }

    /**
     * @return Shop
     */
    public function shop(): Shop
    {
        return new Shop($this->client);
    }

    /**
     * @return User
     */
    public function user(): User
    {
        return new User($this->client);
    }

    /**
     * @return Document
     */
    public function document(): Document
    {
        return new Document($this->client);
    }

    /**
     * @return Shipment
     */
    public function shipment(): Shipment
    {
        return new Shipment($this->client);
    }
}