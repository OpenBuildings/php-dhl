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

        $request->buildBilling('187544124', 'S')
            ->buildConsignee('DHL Express International',
                '178-188 Great South West Road',
                'Hounslow',
                'GB',
                'United Kingdom',
                'Danail Kyosev',
                '+359000000000'
            )
            ->buildShipmentDetails($pieces, 'D', new \DateTime('2014-05-19'), 'Test contents', 'EUR')
            ->buildShipper(
                '187544124',
                'Clippings',
                '13-19 Vine Hill',
                'London',
                'EC1R 5DW',
                'GB',
                'United Kingdom',
                'Danail Kyosev',
                '+359000000000'
            );

        $request->buildRequest();

        // echo $request;
        // $request = $this->buildRequest();
        // echo $request;
        // $xml = file_get_contents(dirname(__FILE__).'/../../xml/ShipmentRequest.xml');

        // $this->assertEquals($xml, (string) $request);
    }
}