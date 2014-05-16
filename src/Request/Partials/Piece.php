<?php

namespace CL\PhpDhl\Request\Partials;

/**
 * @author    Danail Kyosev <ddkyosev@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class Piece extends RequestPartial
{
    protected $required = array(
        'PieceID' => null,
        'Height' => null,
        'Depth' => null,
        'Width' => null,
        'Weight' => null
    );

    /**
     * @param integer $pieceId Piece sequence number
     */
    public function setPieceId($pieceId)
    {
        $this->required['PieceID'] = $pieceId;

        return $this;
    }

    /**
     * @param string $height
     */
    public function setHeight($height)
    {
        $this->required['Height'] = $height;

        return $this;
    }

    /**
     * @param string $depth
     */
    public function setDepth($depth)
    {
        $this->required['Depth'] = $depth;

        return $this;
    }

    /**
     * @param string $width
     */
    public function setWidth($width)
    {
        $this->required['Width'] = $width;

        return $this;
    }

    /**
     * @param string $weight
     */
    public function setWeight($weight)
    {
        $this->required['Weight'] = $weight;

        return $this;
    }
}
