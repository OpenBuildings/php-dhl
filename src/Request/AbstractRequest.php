<?php

namespace CL\PhpDhl\Request;

use CL\PhpDhl\XMLSerializer;
use CL\PhpDhl\Connection\DHLHttpConnection;

/**
 * @author    Danail Kyosev <ddkyosev@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
abstract class AbstractRequest
{
    protected $xml;
    protected $currentRoot;

    public function __construct($siteID, $password)
    {
        $this->siteID = $siteID;
        $this->password = $password;

        // Generate the common elements
        $this->xml = new \DOMDocument('1.0', 'UTF-8');
        $this->xml->formatOutput = true;
        
        $this->buildRoot();
        $this->buildRequestType();
        $this->buildAuthElement($siteID, $password);
    }

    abstract protected function buildRoot();
    abstract protected function buildRequestType();

    public function buildAuthElement($siteID, $password)
    {
        $data = array('ServiceHeader' => array('SiteID' => $siteID, 'Password' => $password));
        $auth = $this->buildElement('Request', $data);
        $this->currentRoot->appendChild($auth);

        return $this;
    }

    public function __toString()
    {
        return $this->xml->saveXML();
    }

    protected function buildElement($name, $data=null)
    {
        return XMLSerializer::serialize($this->xml, $name, $data);
    }

    public function send()
    {
        $connection = new DHLHttpConnection();
        $result = $connection->execute($this->xml->saveXML());

        return $result;
    }
}