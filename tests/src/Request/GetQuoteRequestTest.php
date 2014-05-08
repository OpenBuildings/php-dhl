<?php

namespace CL\PhpDhl\Test;

use CL\PhpDhl\Request\GetQuoteRequest;

class GetQuoteRequestTest extends AbstractTestCase
{
    public function testXML()
    {
        $request = new GetQuoteRequest('CIMGBTest', 'DLUntOcJma');
        $request->buildLocation('From', 'GB', 'EC1R 5DW', 'London');
        $request->buildBkgDetails('GB', new \DateTime('now'), 'PT10H21M', 
            array(array('height' => 10.5, 'width' => 5, 'depth' => 4, 'weight' => 2.5)));
        $request->buildLocation('To', 'BG', '1000', 'Sofia');
        echo $request;

        $this->assertEquals('<?xml version="1.0" encoding="UTF-8"?>
<p:DCTRequest xmlns:p="http://www.dhl.com" xmlns:p1="http://www.dhl.com/datatypes" xmlns:p2="http://www.dhl.com/DCTRequestdatatypes" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.dhl.com DCT-req.xsd ">
  <GetQuote>
    <Request>
      <ServiceHeader>
        <SiteID>CIMGBTest</SiteID>
        <Password>DLUntOcJma</Password>
      </ServiceHeader>
    </Request>
    <From>
      <CountryCode>GB</CountryCode>
      <Postalcode>EC1R 5DW</Postalcode>
      <City>London</City>
    </From>
    <BkgDetails>
      <PaymentCountryCode>GB</PaymentCountryCode>
      <Date>2014-05-08</Date>
      <ReadyTime>PT10H21M</ReadyTime>
      <DimensionUnit>CM</DimensionUnit>
      <WeightUnit>KG</WeightUnit>
      <Pieces>
        <Piece>
          <PieceID>1</PieceID>
          <Height>10.5</Height>
          <Depth>4</Depth>
          <Width>5</Width>
          <Weight>2.5</Weight>
        </Piece>
      </Pieces>
      <IsDutiable>N</IsDutiable>
    </BkgDetails>
    <To>
      <CountryCode>BG</CountryCode>
      <Postalcode>1000</Postalcode>
      <City>Sofia</City>
    </To>
  </GetQuote>
</p:DCTRequest>
', (string) $request);
    }
}
