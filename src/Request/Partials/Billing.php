<?php

namespace CL\PhpDhl\Request\Partials;

/**
 * @author    Danail Kyosev <ddkyosev@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class Billing extends RequestPartial
{
    protected $required = array(
        'ShipperAccountNumber' => null,
        'ShippingPaymentType' => 'S'
    );

    /**
     * @param string $shipperAccountNumber DHL account number of the shipper
     */
    public function setShipperAccountNumber($shipperAccountNumber)
    {
       $this->required['ShipperAccountNumber'] = $shipperAccountNumber;

       return $this;
    }

    /**
     * @param string $shippingPaymentType Method of payment
     *                                    Valid values are S(Shipper), R(Recipient), T(Third Party/Other)
     */
    public function setShippingPaymentType($shippingPaymentType)
    {
       $this->required['ShippingPaymentType'] = $shippingPaymentType;

       return $this;
    }
}
