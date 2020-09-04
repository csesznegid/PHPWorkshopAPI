<?php

/**
 * This file is part of the "PHP Workshop - API" package
 *
 * @author Denes Csesznegi
 * @since  2020.09.03.
 */

spl_autoload_register(
    function($classWithNamespace)
    {
        $classPath = ('./' . str_replace('\\', DIRECTORY_SEPARATOR, $classWithNamespace) . '.php');
        require_once($classPath);
    }
);