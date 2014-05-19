<?php

namespace CL\PhpDhl\Request;

/**
 * @author    Danail Kyosev <ddkyosev@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class ShipmentRequest extends AbstractRequest
{
    protected $required = array(
        'RegionCode' => 'EU',
        'LanguageCode' => 'EN',
        'PiecesEnabled' => 'Y',
        'Billing' => null,
        'Consignee' => null,
        'ShipmentDetails' => null,
        'Shipper' => null
    );

    protected function buildRoot()
    {
        $root = $this->xml->createElementNS("http://www.dhl.com", 'req:ShipmentRequest');
        $root->setAttributeNS(
            'http://www.w3.org/2001/XMLSchema-instance',
            'xsi:schemaLocation',
            'http://www.dhl.com ship-val-global-req.xsd'
        );
        $root->setAttribute('schemaVersion', '2.0');

        $this->currentRoot = $this->xml->appendChild($root);

        return $this;
    }

    protected function buildRequestType()
    {
        // No request type for shipment
        return $this;
    }

    /**
     * @param string $regionCode Indicates the shipment to be routed to the specific region eCom backend.
     *                           Valid values are AP, EU and AM.
     */
    public function setRegionCode($regionCode)
    {
        $this->required['RegionCode'] = $regionCode;

        return $this;
    }

    /**
     * @param string $languageCode ISO language code used by the requestor
     */
    public function setLanguageCode($languageCode)
    {
        $this->required['LanguageCode'] = $languageCode;

        return $this;
    }

    /**
     * @param Partials\Billing $billing Billing information of the shipment
     */
    public function setBilling(Partials\Billing $billing)
    {
        $this->required['Billing'] = $billing;

        return $this;
    }

    /**
     * @param Partials\Consignee $consignee Shipment receiver information
     */
    public function setConsignee(Partials\Consignee $consignee)
    {
        $this->required['Consignee'] = $consignee;

        return $this;
    }

    /**
     * @param Partials\ShipmentDetails $shipmentDetails Shipment details
     */
    public function setShipmentDetails(Partials\ShipmentDetails $shipmentDetails)
    {
        $this->required['ShipmentDetails'] = $shipmentDetails;

        return $this;
    }

    /**
     * @param Partials\Shipper $shipper Shipper information
     */
    public function setShipper(Partials\Shipper $shipper)
    {
        $this->required['Shipper'] = $shipper;

        return $this;
    }

    public function buildBilling($shipperAccountNumber, $shippingPaymentType)
    {
        $billing = new Partials\Billing();
        $billing->setShipperAccountNumber($shipperAccountNumber)
            ->setShippingPaymentType($shippingPaymentType);

        return $this->setBilling($billing);
    }

    public function buildConsignee(
        $companyName,
        $addressLine,
        $city,
        $countryCode,
        $countryName,
        $contactName,
        $contactPhoneNumber
    ) {
        $consignee = new Partials\Consignee();
        $consignee->setCompanyName($companyName)
            ->setAddressLine($addressLine)
            ->setCity($city)
            ->setCountryCode($countryCode)
            ->setCountryName($countryName);

        $contact = new Partials\Contact();
        $contact->setPersonName($contactName)
            ->setPhoneNumber($contactPhoneNumber);

        $consignee->setContact($contact);

        return $this->setConsignee($consignee);
    }

    public function buildShipmentDetails(
        array $pieces,
        $globalProductCode,
        $date,
        $contents,
        $currencyCode,
        $weightUnit = 'K',
        $dimensionUnit = 'C'
    ) {
        $shipmentDetails = new Partials\ShipmentDetails();
        $shipmentDetails->setGlobalProductCode($globalProductCode)
            ->setDate($date)
            ->setContents($contents)
            ->setCurrencyCode($currencyCode)
            ->setWeightUnit($weightUnit)
            ->setDimensionUnit($dimensionUnit);

        $pieceId = 0;
        $weight = 0;
        foreach ($pieces as $pieceData) {
            $piece = new Partials\ShipmentPiece();
            $piece->setPieceId(++$pieceId)
                ->setHeight($pieceData['height'])
                ->setDepth($pieceData['depth'])
                ->setWidth($pieceData['width'])
                ->setWeight($pieceData['weight']);
            $shipmentDetails->addPiece($piece);
            $weight += (float) $pieceData['weight'];
        }
        $shipmentDetails->setNumberOfPieces($pieceId)
            ->setWeight($weight);

        return $this->setShipmentDetails($shipmentDetails);
    }

    public function buildShipper(
        $shipperId,
        $companyName,
        $addressLine,
        $city,
        $postalCode,
        $countryCode,
        $countryName,
        $contactName,
        $contactPhoneNumber
    ) {
        $shipper = new Partials\Shipper();
        $shipper->setShipperId($shipperId)
            ->setCompanyName($companyName)
            ->setAddressLine($addressLine)
            ->setCity($city)
            ->setPostalCode($postalCode)
            ->setCountryCode($countryCode)
            ->setCountryName($countryName);

        $contact = new Partials\Contact();
        $contact->setPersonName($contactName)
            ->setPhoneNumber($contactPhoneNumber);

        $shipper->setContact($contact);

        return $this->setShipper($shipper);
    }
}
