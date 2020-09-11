<?php

/**
 * This file is part of the "PHP Workshop - API" package
 *
 * @author Denes Csesznegi
 * @since  2020.09.10.
 */

namespace Framework\Authentication;

use Framework\Helper\ASCII;

/**
 * Class TokenGenerator
 *
 * @package Framework\Authentication
 * @abstract
 */
abstract class TokenGenerator
{
    /**
     * Generates a token
     *
     * @param  int $length
     * @param  string $prefix
     * @return string
     * @access public
     * @static
     */
    public static function Generate($length = 256, $prefix = '')
    {
        $tokenCharacters = array();
        $characters      = ASCII::GetAlphaNumericCharacters();
        $charactersLen   = (strlen($characters) - 1);

        for ($i = 0; $i < $length; $i++) {
            $random            = rand(0, $charactersLen);
            $tokenCharacters[] = $characters[$random];
        }

        return ($prefix . implode('', $tokenCharacters));
    }
}