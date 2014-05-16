<?php

namespace CL\PhpDhl\Request\Partials;

/**
 * @author    Danail Kyosev <ddkyosev@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class Consignee extends RequestPartial
{
    protected $required = array(
        'CompanyName' => null,
        'AddressLine' => null,
        'CountryCode' => null,
        'CountryName' => null,
        'Contact' => null
    );

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

    /**
     * @param Contact $contact Destination contact details
     */
    public function setContact($contact)
    {
        $this->required['Contact'] = $contact;

        return $this;
    }
}
