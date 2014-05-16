<?php

namespace CL\PhpDhl;

/**
 * @author    Danail Kyosev <ddkyosev@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class XMLSerializer
{

    public static function serialize(\DOMDocument $doc, $name, $data)
    {
        return self::process($doc, $name, $data);
    }

    private static function process(\DOMDocument $doc, $name, $data)
    {
        $element = $doc->createElement($name);

        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if (is_array($value) && is_numeric(key($value))) {
                    // Multiple elements with the same tag
                    foreach ($value as $index => $val) {
                        $element->appendChild(self::process($doc, $key, $val));
                    }
                } else {
                    $element->appendChild(self::process($doc, $key, $value));
                }
            }
        } elseif ($data != null) {
            $element->appendChild($doc->createTextNode( (string) $data));
        }

        return $element;
    }
}
