<?php

namespace CL\PhpDhl\Test;

use CL\PhpDhl\Response\GetQuoteResponse;

class GetQuoteResponseTest extends AbstractTestCase
{
    public function testParsing()
    {
        $xml = file_get_contents(dirname(__FILE__).'/../../xml/GetQuoteResponse.xml');
        $response = new GetQuoteResponse($xml);

        $this->assertEquals(1, count($response->getPrices()));
        $price = $response->getPrices()[0];
        $this->assertEquals('EXPRESS WORLDWIDE', $price->getProductName());
        $this->assertEquals('USD', $price->getCurrencyCode());
        $this->assertEquals('60.600', $price->getWeightCharge());
        $this->assertEquals('0.600', $price->getWeightChargeTax());
        $this->assertEquals('101.040', $price->getTotalAmount());
        $this->assertEquals('1.000', $price->getTotalTaxAmount());
    }
}