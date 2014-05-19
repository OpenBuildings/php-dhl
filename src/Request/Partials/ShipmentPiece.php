<?php

namespace CL\PhpDhl\Request\Partials;

/**
 * @author    Danail Kyosev <ddkyosev@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 *
 * The only reason for this class is to change the order of the Piece fields in the request.
 * This is needed because the XSD is declared as a sequence and differs per request type
 */
class ShipmentPiece extends Piece
{
    protected $required = array(
        'PieceID' => null,
        'Weight' => null,
        'Width' => null,
        'Height' => null,
        'Depth' => null
    );
}
