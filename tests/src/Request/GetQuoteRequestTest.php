<?php

namespace CL\PhpDhl\Test;

use CL\PhpDhl\Request\GetQuoteRequest;

class GetQuoteRequestTest extends AbstractTestCase
{

    private function buildRequest()
    {
        $request = new GetQuoteRequest('CIMGBTest', 'DLUntOcJma');
        $request->buildFrom('ID', '31251', 'PENDOPO')
            ->buildBkgDetails('ID', new \DateTime('2014-05-09'), 
                array(array('height' => 30, 'width' => 10, 'depth' => 20, 'weight' => 1)), 'PT10H21M')
            ->buildTo('JP', '9811513', 'KAKUDA');

        return $request;
    }

    public function testXML()
    {
        $request = $this->buildRequest();
        $xml = file_get_contents(dirname(__FILE__).'/../../xml/GetQuoteRequest.xml');

        $this->assertEquals($xml, (string) $request);
    }

    public function testSend()
    {
        $request = $this->buildRequest();

        $response = $request->send();

        $doc = new \DOMDocument();
        $doc->formatOutput = true;
        $doc->loadXML($response);
    }
}
