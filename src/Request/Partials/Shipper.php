<?php

namespace CL\PhpDhl\Request\Partials;

/**
 * @author    Danail Kyosev <ddkyosev@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class Shipper extends RequestPartial
{
    protected $required = array(
        'ShipperID' => null,
        'CompanyName' => null,
        'AddressLine' => null,
        'CountryCode' => null,
        'CountryName' => null
    );

    /**
     * @param string $shipperId Shipper's account number
     */
    public function setShipperId($shipperId)
    {
       $this->required['ShipperID'] = $shipperId;

       return $this;
    }

    /**
     * @param string $companyName Name of the company
     */
    public function setCompanyName($companyName)
    {
       $this->required['CompanyName'] = $companyName;

       return $this;
    }

    /**
     * @param string $addressLine Company address
     */
    public function setAddressLine($addressLine)
    {
       $this->required['AddressLine'] = $addressLine;

       return $this;
    }

    /**
     * @param string $countryCode 2 letter ISO country code
     */
    public function setCountryCode($countryCode)
    {
       $this->required['CountryCode'] = $countryCode;

       return $this;
    }

    /**
     * @param string $countryName Country name
     */
    public function setCountryName($countryName)
    {
       $this->required['CountryName'] = $countryName;

       return $this;
    }
}
