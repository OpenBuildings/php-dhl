<?php

namespace CL\PhpDhl\Test;

use CL\PhpDhl\Request\ShipmentRequest;
use CL\PhpDhl\Request\Partials;

class ShipmentRequestTest extends AbstractTestCase
{
    private function buildRequest()
    {
        $request = new ShipmentRequest('CIMGBTest', 'DLUntOcJma');

        $pieces = array(array('height' => 30, 'width' => 10, 'depth' => 20, 'weight' => 5));

        $request->buildBilling('187544124', 'S')
            ->buildConsignee('DHL Express International',
                '178-188 Great South West Road',
                'Hounslow',
                'TW4 6JS',
                'GB',
                'United Kingdom',
                'Danail Kyosev',
                '+359000000000'
            )
            ->buildShipmentDetails($pieces, '1', 'V', new \DateTime('now'), 'Test contents', 'GBP')
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

        return $request;
    }

    public function testXML()
    {
        $request = $this->buildRequest();

        // echo $request;
        // $xml = file_get_contents(dirname(__FILE__).'/../../xml/ShipmentRequest.xml');

        // $this->assertEquals($xml, (string) $request);
    }

    public function testSend()
    {
        $request = $this->buildRequest();

        $response = $request->send();

        $doc = new \DOMDocument();
        $doc->formatOutput = true;
        $doc->loadXML($response);

        // echo $doc->saveXML();
    }
}