<?php

namespace CL\PhpDhl\Connection;

use PhpDhl\Exception\DHLConnectionException;

/**
 * @author    Danail Kyosev <ddkyosev@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class DHLHttpConnection
{

    private $api_url = 'https://xmlpitest-ea.dhl.com/XMLShippingServlet';

    public function __construct()
    {
        if ( !function_exists("curl_init") ) {
            throw new DHLException("Curl module is not available on this system");
        }
    }

    /**
     * @param string $data
     */
    public function execute($data)
    {
        $ch = curl_init($this->api_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $response = curl_exec($ch);

        if ( curl_errno($ch) ) {
            $exception = new DHLConnectionException(curl_error($ch), curl_errno($ch));
            curl_close($ch);
            throw $exception;
        }

        curl_close($ch);

        return $response;
    }
}
