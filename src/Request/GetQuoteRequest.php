<?php

namespace CL\PhpDhl\Request;

/**
 * @author    Danail Kyosev <ddkyosev@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class GetQuoteRequest extends AbstractRequest
{
    protected function buildRoot()
    {
        $root = $this->xml->createElementNS("http://www.dhl.com", 'p:DCTRequest');
        
        $root->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:p1', 
            'http://www.dhl.com/datatypes');
        $root->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:p2', 
            'http://www.dhl.com/DCTRequestdatatypes');
        $root->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:xsi', 
            'http://www.w3.org/2001/XMLSchema-instance');
        $root->setAttributeNS('http://www.w3.org/2001/XMLSchema-instance', 'schemaLocation', 
            'http://www.dhl.com DCT-req.xsd ');

        $this->currentRoot = $this->xml->appendChild($root);
    }

    protected function buildRequestType()
    {
        $type = $this->buildElement('GetQuote');
        $this->currentRoot = $this->currentRoot->appendChild($type);

        return $this;
    }

    private function buildLocation($tag, $country_code, $postal_code=null, $city=null)
    {
        $data = array('CountryCode' => $country_code, 'Postalcode' => $postal_code, 'City' => $city);
        $location = $this->buildElement($tag, $data);

        $this->currentRoot->appendChild($location);

        return $this;
    }

    public function buildFrom($country_code, $postal_code=null, $city=null)
    {
        return $this->buildLocation('From', $country_code, $postal_code, $city);
    }

    public function buildTo($country_code, $postal_code=null, $city=null)
    {
        return $this->buildLocation('To', $country_code, $postal_code, $city);
    }

    public function buildBkgDetails($payment_country_code, $date, $ready_time, 
        array $pieces, $dimension_unit='CM', $weight_unit='KG', $is_dutiable = false)
    {
        $data = array('PaymentCountryCode' => $payment_country_code,
            'Date' => $date->format('Y-m-d'),
            'ReadyTime' => $ready_time,
            'DimensionUnit' => $dimension_unit,
            'WeightUnit' => $weight_unit,
            'Pieces' => array('Piece' => array()),
            'IsDutiable' => $is_dutiable ? 'Y' : 'N');

        $piece_id = 1;
        foreach ($pieces as $piece => $piece_data) {
            $data['Pieces']['Piece'][] = array('PieceID' => $piece_id,
                'Height' => $piece_data['height'],
                'Depth' => $piece_data['depth'],
                'Width' => $piece_data['width'],
                'Weight' => $piece_data['weight']);
            $piece_id++;
        }

        $details = $this->buildElement('BkgDetails', $data);
        $this->currentRoot->appendChild($details);

        return $this;
    }

}