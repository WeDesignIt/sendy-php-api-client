<?php

namespace WeDesignIt\Sendy\Filters\Carrier;

use WeDesignIt\Sendy\Filters\ArrayFilter;

class Service extends ArrayFilter
{

    public const COUNTRY = 'country';
    public const PRODUCT_TYPE = 'product_type';
    public const DELIVERY_TYPE = 'delivery_type';

    public const PRODUCT_TYPE_MAILBOX_PACKAGE = 1;
    public const PRODUCT_TYPE_PACKAGE = 2;
    public const PRODUCT_TYPE_PALLET = 3;

    public const DELIVERY_TYPE_ADDRESS = 1;
    public const DELIVERY_TYPE_PARCEL_SHOP = 2;

    /**
     * @var array
     */
    protected array $filters = [];

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    /**
     * Fluent setter
     *
     * @param string $iso2
     *
     * @return self
     */
    public function country(string $iso2): self
    {
        $this->offsetSet(self::COUNTRY, $iso2);

        return $this;
    }

    /**
     * Fluent setter
     *
     * @param int $productType
     *
     * @return self
     */
    public function productType(int $productType): self
    {
        $this->offsetSet(self::PRODUCT_TYPE, $productType);

        return $this;
    }

    /**
     * Fluent setter
     *
     * @param int $deliveryType
     *
     * @return self
     */
    public function deliveryType(int $deliveryType): self
    {
        $this->offsetSet(self::DELIVERY_TYPE, $deliveryType);

        return $this;
    }


}