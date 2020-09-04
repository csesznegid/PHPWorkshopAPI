<?php

/**
 * This file is part of the "PHP Workshop - API" package
 *
 * @author Denes Csesznegi
 * @since  2020.09.03.
 */

namespace Framework\Response;

use Framework\Helper\JSON;

/**
 * Class for returning a HTTP Response as JSON
 *
 * @package Framework\Response
 */
class JSONResponse
{
    /**
     * @var    mixed $data
     * @access protected
     */
    protected $data;

    /**
     * @param  mixed $data
     * @access public
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Returns the JSON representation of the given data
     * when the object is being printed out
     *
     * @return string
     * @throws \Framework\Helper\Exception\JSONParseException
     * @access public
     */
    public function __toString()
    {
        return JSON::Encode($this->data);
    }
}