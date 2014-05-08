<?php

namespace CL\PhpDhl\Test;

use CL\PhpDhl\XMLSerializer;

class XMLSerializerTest extends AbstractTestCase
{
    public function testSimple()
    {
        $doc = new \DOMDocument('1.0', 'UTF-8');
        $doc->formatOutput = true;
        $xml = XMLSerializer::serialize($doc, 'foo', 'bar');
        $doc->appendChild($xml);

        $this->assertEquals('<?xml version="1.0" encoding="UTF-8"?>
<foo>bar</foo>
', $doc->saveXML());
    }

    public function testEmpty()
    {
        $doc = new \DOMDocument('1.0', 'UTF-8');
        $doc->formatOutput = true;
        $xml = XMLSerializer::serialize($doc, 'foo', array('bar' => '', 'baf' => null));
        $doc->appendChild($xml);

        $this->assertEquals('<?xml version="1.0" encoding="UTF-8"?>
<foo>
  <bar/>
  <baf/>
</foo>
', $doc->saveXML());
    }

    public function testObject()
    {
        $doc = new \DOMDocument('1.0', 'UTF-8');
        $doc->formatOutput = true;
        $xml = XMLSerializer::serialize($doc, 'foo', array('bar' => 'baz', 'baf' => array('zab' => 'rab')));
        $doc->appendChild($xml);

        $this->assertEquals('<?xml version="1.0" encoding="UTF-8"?>
<foo>
  <bar>baz</bar>
  <baf>
    <zab>rab</zab>
  </baf>
</foo>
', $doc->saveXML());     
    }

    public function testMultiple()
    {
        $doc = new \DOMDocument('1.0', 'UTF-8');
        $doc->formatOutput = true;
        $xml = XMLSerializer::serialize($doc, 'foo', 
            array('bar' => 'baz', 'bafs' => array('baf' => array('zab', 'rab'))));
        $doc->appendChild($xml);
        
        $this->assertEquals('<?xml version="1.0" encoding="UTF-8"?>
<foo>
  <bar>baz</bar>
  <bafs>
    <baf>zab</baf>
    <baf>rab</baf>
  </bafs>
</foo>
', $doc->saveXML());
    }
}