<?php

namespace WeDesignIt\Sendy\Interfaces;

interface HasRequiredFields
{

    /**
     * Returns the required fields
     *
     * @return array
     */
    public function getRequiredFields(): array;
}
