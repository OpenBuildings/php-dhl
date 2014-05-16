<?php

namespace CL\PhpDhl\Response\Partials;

/**
 * @author    Danail Kyosev <ddkyosev@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class Price
{
    private $productName;
    private $currencyCode;
    private $weightCharge;
    private $weightChargeTax;
    private $totalAmmount;
    private $totalTaxAmmount;

    public function getProductName()
    {
        return $this->productName;
    }

    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    public function getWeightCharge()
    {
        return $this->weightCharge;
    }

    public function getWeightChargeTax()
    {
        return $this->weightChargeTax;
    }

    public function getTotalAmount()
    {
        return $this->totalAmmount;
    }

    public function getTotalTaxAmount()
    {
        return $this->totalTaxAmmount;
    }

    public function __construct($data)
    {
        $this->productName = (string) $data->ProductShortName;
        $this->currencyCode = (string) $data->CurrencyCode;
        $this->weightCharge = (string) $data->WeightCharge;
        $this->weightChargeTax = (string) $data->WeightChargeTax;
        $this->totalAmmount = (string) $data->ShippingCharge;
        $this->totalTaxAmmount = (string) $data->TotalTaxAmount;
    }

}
