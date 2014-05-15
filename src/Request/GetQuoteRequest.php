<?php

namespace CL\PhpDhl\Request;

use CL\PhpDhl\Request\Partials;

/**
 * @author    Danail Kyosev <ddkyosev@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class GetQuoteRequest extends AbstractRequest
{
    protected $required = array(
        'From' => null,
        'BkgDetails' => null,
        'To' => null
    );

    protected function buildRoot()
    {
        $root = $this->xml->createElementNS("http://www.dhl.com", 'p:DCTRequest');
        $root->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:p1', 
            'http://www.dhl.com/datatypes');
        $root->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:p2', 
            'http://www.dhl.com/DCTRequestdatatypes');
        $root->setAttributeNS('http://www.w3.org/2001/XMLSchema-instance', 'xsi:schemaLocation', 
            'http://www.dhl.com DCT-req.xsd ');

        $this->currentRoot = $this->xml->appendChild($root);

        return $this;
    }

    protected function buildRequestType()
    {
        $type = $this->buildElement('GetQuote');
        $this->currentRoot = $this->currentRoot->appendChild($type);

        return $this;
    }

    /**
     * @param CL\PhpDhl\Request\Partials\Location $from Origin address of the shipment
     */
    public function setFrom($from)
    {
        $this->required['From'] = $from;
        return $this;
    }

    /**
     * @param CL\PhpDhl\Request\Partials\Location $to Destination address of the shipment
     */
    public function setTo($to)
    {
        $this->required['To'] = $to;
        return $this;
    }

    /**
     * @param CL\PhpDhl\Request\Partials\BkgDetails $bkgDetails Shipment details
     */
    public function setBkgDetails($bkgDetails)
    {
        $this->required['BkgDetails'] = $bkgDetails;
        return $this;
    }

    /**
     * @return CL\PhpDhl\Request\Partials\BkgDetails|null
     */
    public function getBkgDetails()
    {
        return $this->required['BkgDetails'];
    }   


    private function buildLocation($tag, $countryCode, $postalCode=null, $city=null)
    {
        $location = new Partials\Location();
        $location->setCountryCode($countryCode)
            ->setPostalCode($postalCode)
            ->setCity($city);

        $setter = "set$tag";
        return $this->$setter($location);
    }

    public function buildFrom($countryCode, $postalCode=null, $city=null)
    {
        return $this->buildLocation('From', $countryCode, $postalCode, $city);
    }

    public function buildTo($countryCode, $postalCode=null, $city=null)
    {
        return $this->buildLocation('To', $countryCode, $postalCode, $city);
    }

    /**
     * Add details of the shippment
     * @param string $paymentCountryCode
     * @param DateTime $date
     * @param array $pieces Each piece element is an array with height, width, depth and weight keys
     */
    public function buildBkgDetails($paymentCountryCode, $date, array $pieces, 
        $readyTime='PT10H00M', $dimensionUnit='CM', $weightUnit='KG', $isDutiable = false)
    {
        $bkgDetails = new Partials\BkgDetails();

        $bkgDetails->setPaymentCountryCode($paymentCountryCode)
            ->setDate($date)
            ->setReadyTime($readyTime)
            ->setDimensionUnit($dimensionUnit)
            ->setWeightUnit($weightUnit)
            ->setIsDutiable($isDutiable);

        $pieceId = 0;
        foreach ($pieces as $pieceData) {
            $piece = new Partials\Piece();
            $piece->setPieceId(++$pieceId)
                ->setHeight($pieceData['height'])
                ->setDepth($pieceData['depth'])
                ->setWidth($pieceData['width'])
                ->setWeight($pieceData['weight']);
            $bkgDetails->addPiece($piece);
        }

        return $this->setBkgDetails($bkgDetails);
    }

}