<?php

spl_autoload_register(
    function($classWithNamespace)
    {
        $classPath = ('./' . str_replace('\\', DIRECTORY_SEPARATOR, $classWithNamespace) . '.php');
        require_once($classPath);
    }
);