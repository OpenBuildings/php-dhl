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
        $root->setAttributeNS('http://www.w3.org/2001/XMLSchema-instance', 'xsi:schemaLocation', 
            'http://www.dhl.com ship-val-global-req.xsd');
        $root->setAttribute('schemaVersion', '1.0');

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
     * Valid values are AP, EU and AM.
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
     * @param CL\PhpDhl\Request\Partials\Billing $billing Billing information of the shipment
     */
    public function setBilling(Partials\Billing $billing)
    {
        $this->required['Billing'] = $billing;
        return $this;
    }

    /**
     * @param CL\PhpDhl\Request\Partials\Consignee $consignee Shipment receiver information
     */
    public function setConsignee(Partials\Consignee $consignee)
    {
        $this->required['Consignee'] = $consignee;
        return $this;
    }

    /**
     * @param CL\PhpDhl\Request\Partials\ShipmentDetails $shipmentDetails Shipment details
     */
    public function setShipmentDetails(Partials\ShipmentDetails $shipmentDetails)
    {
        $this->required['ShipmentDetails'] = $shipmentDetails;
        return $this;
    }

    /**
     * @param CL\PhpDhl\Request\Partials\Shipper $shipper Shipper information
     */
    public function setShipper(Partials\Shipper $shipper)
    {
        $this->required['Shipper'] = $shipper;
        return $this;
    }

}