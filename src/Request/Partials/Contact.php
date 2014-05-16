<?php

namespace CL\PhpDhl\Request\Partials;

/**
 * @author    Danail Kyosev <ddkyosev@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class Contact extends RequestPartial
{
    protected $required = array(
        'PersonName' => null,
        'PhoneNumber' => null
    );

    /**
     * @param string $personName Contact's name
     */
    public function setPersonName($personName)
    {
       $this->required['PersonName'] = $personName;

       return $this;
    }

    /**
     * @param string $phoneNumber Contact's phone number
     */
    public function setPhoneNumber($phoneNumber)
    {
       $this->required['PhoneNumber'] = $phoneNumber;

       return $this;
    }
}
