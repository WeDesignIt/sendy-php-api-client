<?php

namespace WeDesignIt\Sendy\Filters\Carrier;

use WeDesignIt\Sendy\Exceptions\FilterException;
use WeDesignIt\Sendy\Filters\ArrayFilter;

class ParcelShop extends ArrayFilter
{

    public const CARRIERS = 'carriers';
    public const LATITUDE = 'latitude'; // required
    public const LONGITUDE = 'longitude'; // required
    public const COUNTRY = 'country'; // required
    public const POSTAL_CODE = 'postal_code';

    public const CARRIER_DHL = 'DHL';
    public const CARRIER_DPD = 'DPD';
    public const CARRIER_POSTNL = 'PostNL';

    public function carriers(array $carriers): self
    {
        $this->offsetSet(self::CARRIERS, $carriers);

        return $this;
    }

    public function carrier(string $carrier): self
    {
        $this->offsetSet(self::CARRIERS, [$carrier]);

        return $this;
    }

    public function latitude(float $latitude): self
    {
        if ($latitude < -90 || $latitude > 90) {
            throw new FilterException('Latitude must be between -90 and 90');
        }
        $this->offsetSet(self::LATITUDE, $latitude);

        return $this;
    }

    public function longitude(float $longitude): self
    {
        if ($longitude < -180 || $longitude > 180) {
            throw new FilterException('Longitude must be between -180 and 180');
        }
        $this->offsetSet(self::LONGITUDE, $longitude);

        return $this;
    }

    public function country(string $country): self
    {
        $this->offsetSet(self::COUNTRY, $country);

        return $this;
    }

    public function postalCode(string $postalCode): self
    {
        // remove spaces
        $postalCode = str_replace(' ', '', $postalCode);
        $this->offsetSet(self::POSTAL_CODE, $postalCode);

        return $this;
    }

}