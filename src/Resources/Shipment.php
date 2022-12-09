<?php

namespace WeDesignIt\Sendy\Resources;

use WeDesignIt\Sendy\Resources\Shipment\Product;

class Shipment extends Resource
{

    public const CARRIER = 'carrier';
    public const SERVICE = 'service';
    public const SHOP_ID = 'shop_id';
    public const COMPANY_NAME = 'company_name';
    public const CONTACT = 'contact';
    public const VAT_NUMBER = 'vat_number';
    public const STREET = 'street';
    public const NUMBER = 'number';
    public const ADDITION = 'addition';
    public const COMMENT = 'comment';
    public const POSTAL_CODE = 'postal_code';
    public const CITY = 'city';
    public const PHONE = 'phone';
    public const EMAIL = 'email';
    public const COUNTRY = 'country';
    public const REFERENCE = 'reference';
    public const WEIGHT = 'weight';
    public const AMOUNT = 'amount';
    public const OPTIONS = 'options';
    public const PRODUCTS = 'products';

    /**
     * @return array
     */
    public function getRequiredFields(): array
    {
        return [
            self::CARRIER, self::SERVICE, self::SHOP_ID, self::STREET, self::CITY, self::COUNTRY, self::REFERENCE,
            self::WEIGHT, self::AMOUNT,
        ];
    }

    /**
     * This should match a carrier's value property (e.g. DPD / DHL / PostNL)
     *
     * @see https://portal.keendelivery.com/api/v3/docs#tag/Carriers
     *
     * @param string $carrier
     *
     * @return self
     */
    public function carrier(string $carrier): self
    {
        $this->offsetSet(self::CARRIER, $carrier);

        return $this;
    }

    /**
     * This should match a service's value property (e.g. DPD_HOME_DROP_OFF)
     *
     * @see https://portal.keendelivery.com/api/v3/docs#tag/Services
     *
     * @param string $service
     *
     * @return self
     */
    public function service(string $service): self
    {
        $this->offsetSet(self::SERVICE, $service);

        return $this;
    }

    /**
     * @param string $shopId (UUID)
     *
     * @return self
     */
    public function shopId(string $shopId): self
    {
        $this->offsetSet(self::SHOP_ID, $shopId);

        return $this;
    }

    /**
     * @param string $companyName max 35 chars.
     *
     * @return self
     */
    public function companyName(string $companyName): self
    {
        $companyName = substr($companyName, 0, 35);
        $this->offsetSet(self::COMPANY_NAME, $companyName);

        return $this;
    }

    /**
     * @param string $contact max 35 chars.
     *
     * @return self
     */
    public function contact(string $contact): self
    {
        $contact = substr($contact, 0, 35);
        $this->offsetSet(self::CONTACT, $contact);

        return $this;
    }

    /**
     * @param string $vatNumber max 20 chars.
     *
     * @return self
     */
    public function vatNumber(string $vatNumber): self
    {
        $vatNumber = substr($vatNumber, 0, 20);
        $this->offsetSet(self::VAT_NUMBER, $vatNumber);

        return $this;
    }

    /**
     * @param string $street max 35 chars.
     *
     * @return self
     */
    public function street(string $street): self
    {
        $street = substr($street, 0, 35);
        $this->offsetSet(self::STREET, $street);

        return $this;
    }

    /**
     * @param string $number
     *
     * @return self
     */
    public function number(string $number): self
    {
        $this->offsetSet(self::NUMBER, $number);

        return $this;
    }

    /**
     * @param string $addition
     *
     * @return self
     */
    public function addition(string $addition): self
    {
        $this->offsetSet(self::ADDITION, $addition);

        return $this;
    }

    /**
     * @param string $comment max 35 chars.
     *
     * @return self
     */
    public function comment(string $comment): self
    {
        $comment = substr($comment, 0, 35);
        $this->offsetSet(self::COMMENT, $comment);

        return $this;
    }

    /**
     * @param string $postalCode max 12 chars.
     *
     * @return self
     */
    public function postalCode(string $postalCode): self
    {
        $postalCode = substr($postalCode, 0, 12);
        $this->offsetSet(self::POSTAL_CODE, $postalCode);

        return $this;
    }

    /**
     * @param string $city max 35 chars.
     *
     * @return self
     */
    public function city(string $city): self
    {
        $city = substr($city, 0, 35);
        $this->offsetSet(self::CITY, $city);

        return $this;
    }

    /**
     * @param string $phone max 30 chars.
     *
     * @return self
     */
    public function phone(string $phone): self
    {
        $phone = substr($phone, 0, 30);
        $this->offsetSet(self::PHONE, $phone);

        return $this;
    }

    /**
     * @param string $email
     *
     * @return self
     */
    public function email(string $email): self
    {
        $this->offsetSet(self::EMAIL, $email);

        return $this;
    }

    /**
     * @param string $country max 2 chars.
     *
     * @return self
     */
    public function country(string $country): self
    {
        $country = substr($country, 0, 2);
        $this->offsetSet(self::COUNTRY, $country);

        return $this;
    }

    /**
     * @param string $reference max 35 chars.
     *
     * @return self
     */
    public function reference(string $reference): self
    {
        $reference = substr($reference, 0, 35);
        $this->offsetSet(self::REFERENCE, $reference);

        return $this;
    }

    /**
     * The shipment’s total weight in kilograms.
     *
     * @param float $weight
     *
     * @return self
     */
    public function weight(float $weight): self
    {
        $this->offsetSet(self::WEIGHT, $weight);

        return $this;
    }

    /**
     * The number of packages in the shipment.
     *
     * @param int $amount
     *
     * @return self
     */
    public function amount(int $amount): self
    {
        if ($amount < 1) {
            throw new \InvalidArgumentException('Amount should be at least 1');
        }
        $this->offsetSet(self::AMOUNT, $amount);

        return $this;
    }

    /**
     * Key/value pairs of service options. The options available for each service may can be found in the response body
     * of the services endpoints.
     *
     * @see https://portal.keendelivery.com/api/v3/docs#tag/Services
     *
     * @param array $options
     *
     * @return $this
     */
    public function options(array $options): self
    {
        $this->offsetSet(self::OPTIONS, $options);

        return $this;
    }

    /**
     *
     * @param array $products
     *
     * @return $this
     */
    public function products(array $products): self
    {
        $data = [];
        foreach ($products as $product) {
            if (is_array($product)) {
                $data[] = $product;
            } elseif ($product instanceof Product) {
                $data[] = $product->toArray();
            } else {
                throw new \InvalidArgumentException('Products should be an array of arrays or Product (Resource) objects');
            }
        }

        $this->offsetSet(self::PRODUCTS, $data);

        return $this;
    }
}