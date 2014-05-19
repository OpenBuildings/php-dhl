<?php

namespace CL\PhpDhl\Request\Partials;

/**
 * @author    Danail Kyosev <ddkyosev@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class BkgDetails extends RequestPartial
{
    protected $required = array(
        'PaymentCountryCode' => null,
        'Date' => null,
        'ReadyTime' => 'PT10H00M',
        'DimensionUnit' => 'CM',
        'WeightUnit' => 'KG',
        'Pieces' => array(),
        'IsDutiable' => 'N'
    );

    /**
     * @param string $paymentCountryCode Two letter ISO country code of the payment country
     */
    public function setPaymentCountryCode($paymentCountryCode)
    {
        $this->required['PaymentCountryCode'] = $paymentCountryCode;

        return $this;
    }

    /**
     * @param \DateTime $date Pickup date of the shipment
     */
    public function setDate(\DateTime $date)
    {
        $this->required['Date'] = $date->format('Y-m-d');

        return $this;
    }

    /**
     * @param string $readyTime Time when the shipment can be picked up. Format is ISO 8601 (PTnHnM)
     */
    public function setReadyTime($readyTime)
    {
        $this->required['ReadyTime'] = $readyTime;

        return $this;
    }

    /**
     * @param string $dimensionUnit Unit of measurement for the pieces
     *                              Valid values are CM and IN
     */
    public function setDimensionUnit($dimensionUnit)
    {
        $this->required['DimensionUnit'] = $dimensionUnit;

        return $this;
    }

    /**
     * @param string $weightUnit Unit of measurement for the shipment weight
     *                           Valid values are KB and LB
     */
    public function setWeightUnit($weightUnit)
    {
        $this->required['WeightUnit'] = $weightUnit;

        return $this;
    }

    /**
     * @param Piece[] $pieces Individual piece information of the shipment
     */
    public function setPieces($pieces)
    {
        $this->required['Pieces']['Piece'] = $pieces;

        return $this;
    }

    /**
     * @param Piece $piece Add a single piece item to the shipment
     */
    public function addPiece($piece)
    {
        if (! isset($this->required['Pieces']['Piece'])) {
            $this->required['Pieces']['Piece'] = array();
        }
        $this->required['Pieces']['Piece'][] = $piece;

        return $this;
    }

    /**
     * @param boolean $isDutiable
     */
    public function setIsDutiable($isDutiable)
    {
        $this->required['IsDutiable'] = $isDutiable ? 'Y' : 'N';

        return $this;
    }
}
