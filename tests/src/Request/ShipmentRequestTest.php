<?php

namespace CL\PhpDhl\Test;

use CL\PhpDhl\Request\ShipmentRequest;
use CL\PhpDhl\Request\Partials;

class ShipmentRequestTest extends AbstractTestCase
{
    private function getRequest()
    {
        return new ShipmentRequest('CIMGBTest', 'DLUntOcJma');
    }

    public function testXML()
    {
        $request = $this->getRequest();

        $billing = new Partials\Billing();
        $billing->setShipperAccountNumber('1234')
            ->setShippingPaymentType('S');

        $request->setBilling($billing);
        $request->buildRequest();

        //echo $request;
        // $request = $this->buildRequest();
        // echo $request;
        // $xml = file_get_contents(dirname(__FILE__).'/../../xml/ShipmentRequest.xml');

        // $this->assertEquals($xml, (string) $request);
    }
}