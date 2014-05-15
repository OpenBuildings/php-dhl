<?php

namespace CL\PhpDhl\Request;

use CL\PhpDhl\XMLSerializer;
use CL\PhpDhl\Connection\DHLHttpConnection;
use CL\PhpDhl\Request\Partials\RequestPartial;

/**
 * @author    Danail Kyosev <ddkyosev@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
abstract class AbstractRequest
{
    protected $xml;
    protected $currentRoot;

    private $siteId;
    private $password;

    protected $required;

    public function __construct($siteId, $password)
    {
        $this->siteId = $siteId;
        $this->password = $password;
    }

    abstract protected function buildRoot();
    abstract protected function buildRequestType();

    private function buildAuthElement()
    {
        $data = array('ServiceHeader' => array('SiteID' => $this->siteId, 'Password' => $this->password));
        $auth = $this->buildElement('Request', $data);
        $this->currentRoot->appendChild($auth);

        return $this;
    }

    public function __toString()
    {
        $this->buildRequest();
        return $this->xml->saveXML();
    }

    protected function buildElement($name, $data=null)
    {
        return XMLSerializer::serialize($this->xml, $name, $data);
    }

    public function send()
    {
        $this->buildRequest();

        $connection = new DHLHttpConnection();
        $result = $connection->execute($this->xml->saveXML());

        return $result;
    }

    public function buildRequest()
    {
        $this->xml = new \DOMDocument('1.0', 'UTF-8');
        $this->xml->formatOutput = true;

        $this->buildRoot()
            ->buildRequestType()
            ->buildAuthElement();

        foreach($this->required as $key => $value) {
            if($value instanceof RequestPartial) {
                $element = $this->buildElement($key, $value->toArray());
            } else {
                $element = $this->buildElement($key, $value);
            }
            $this->currentRoot->appendChild($element);
        }

        return $this;
    }
}