<?php

namespace CL\PhpDhl\Request\Partials;

/**
 * @author    Danail Kyosev <ddkyosev@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class RequestPartial
{
    protected $required = array();

    public function toArray()
    {
        return $this->convertToArray($this->required);
    }

    private function convertToArray($data)
    {
        $result = array();
        foreach ($data as $key => $value) {
            if ($value instanceof RequestPartial) {
                $result[$key] = $value->toArray();
            } elseif (is_array($value)) {
                $result[$key] = $this->convertToArray($value);
            } else {
                $result[$key] = $value;
            }
        }

        return $result;
    }
}
