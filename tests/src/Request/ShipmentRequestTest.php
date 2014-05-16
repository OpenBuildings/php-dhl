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

        $pieces = array(array('height' => 30, 'width' => 10, 'depth' => 20, 'weight' => 5));

        $request->buildBilling('1234', 'S')
            ->buildConsignee('Despark', 'Benkovski 11', 'Sofia', 'BG', 'Bulgaria', 'Danail Kyosev', '+359000000000')
            ->buildShipmentDetails($pieces, 'P', new \DateTime('2014-05-09'), 'EUR')
            ->buildShipper('1234', 'Clippings', '13-19 Vine Hill', 'London', 'GB', 'United Kingdom');

        $request->buildRequest();

        // echo $request;
        // $request = $this->buildRequest();
        // echo $request;
        // $xml = file_get_contents(dirname(__FILE__).'/../../xml/ShipmentRequest.xml');

        // $this->assertEquals($xml, (string) $request);
    }
}