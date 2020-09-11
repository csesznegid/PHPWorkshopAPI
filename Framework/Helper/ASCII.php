<?php

/**
 * This file is part of the "PHP Workshop - API" package
 *
 * @author Denes Csesznegi
 * @since  2020.09.10.
 */

namespace Framework\Helper;

/**
 * ASCII helper class
 *
 * @package Framework\Helper
 */
abstract class ASCII
{
    /**
     * Get characters of ASCII
     *
     * @return string
     * @access public
     * @static
     */
    public static function GetCharacters()
    {
        $ascii = array();
        for ($i = 0; $i < 127; $i++) {
            $ascii[] = chr($i);
        }

        return implode('', $ascii);
    }
}