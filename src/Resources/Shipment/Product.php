<?php

namespace WeDesignIt\Sendy\Resources\Shipment;

use WeDesignIt\Sendy\Resources\Resource;

class Product extends Resource
{

    public const DESCRIPTION = 'description';
    public const QUANTITY = 'quantity';
    public const NET_WEIGHT = 'net_weight';
    public const VALUE = 'value';
    public const HS_TARIFF_NUMBER = 'hs_tariff_number';
    public const ORIGIN_COUNTRY_CODE = 'origin_country_code';

    /**
     * @param string $description
     *
     * @return self
     */
    public function description(string $description): self
    {
        // string <= 35 characters
        $description = substr($description, 0, 35);

        $this->offsetSet(self::DESCRIPTION, $description);

        return $this;
    }

    /**
     * The total number of items of this product.
     *
     * @param int $quantity
     *
     * @return self
     */
    public function quantity(int $quantity): self
    {
        $this->offsetSet(self::QUANTITY, $quantity);

        return $this;
    }

    /**
     * The total weight of the product in kilograms.
     *
     * @param float $netWeight
     *
     * @return self
     */
    public function netWeight(float $netWeight): self
    {
        $this->offsetSet(self::NET_WEIGHT, $netWeight);

        return $this;
    }

    /**
     * The total value of this product (EUR).
     *
     * @param float $value
     *
     * @return self
     */
    public function value(float $value): self
    {
        $this->offsetSet(self::VALUE, $value);

        return $this;
    }

    /**
     * The HS code classifying this product.
     *
     * @see https://keendelivery.freshdesk.com/support/solutions/articles/14000073147
     *
     * @param string $hsTariffNumber
     *
     * @return self
     */
    public function hsTariffNumber(string $hsTariffNumber): self
    {
        $this->offsetSet(self::HS_TARIFF_NUMBER, $hsTariffNumber);

        return $this;
    }

    /**
     * The country of origin of this product.
     *
     * @param string $originCountryCode
     *
     * @return self
     */
    public function originCountryCode(string $originCountryCode): self
    {
        $this->offsetSet(self::ORIGIN_COUNTRY_CODE, $originCountryCode);

        return $this;
    }
}