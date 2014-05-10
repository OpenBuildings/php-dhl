<?php

namespace CL\PhpDhl\Response\Partial;

/**
 * @author    Danail Kyosev <ddkyosev@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class Price
{
    private $product_name;
    private $currency_code;
    private $weight_charge;
    private $weight_charge_tax;
    private $total_ammount;
    private $total_tax_ammount;

    public function getProductName()
    {
        return $this->product_name;
    }

    public function getCurrencyCode()
    {
        return $this->currency_code;
    }

    public function getWeightCharge()
    {
        return $this->weight_charge;
    }

    public function getWeightChargeTax()
    {
        return $this->weight_charge_tax;
    }

    public function getTotalAmount()
    {
        return $this->total_ammount;
    }

    public function getTotalTaxAmount()
    {
        return $this->total_tax_ammount;
    }

    public function __construct($data)
    {
        $this->product_name = (string) $data->ProductShortName;
        $this->currency_code = (string) $data->CurrencyCode;
        $this->weight_charge = (string) $data->WeightCharge;
        $this->weight_charge_tax = (string) $data->WeightChargeTax;
        $this->total_ammount = (string) $data->ShippingCharge;
        $this->total_tax_ammount = (string) $data->TotalTaxAmount;
    }

}