<?php

/**
 * This file is part of the "PHP Workshop - API" package
 *
 * @author Denes Csesznegi
 * @since  2020.09.03.
 */

$service = (array_key_exists('service', $_REQUEST) ? $_REQUEST['service'] : '');
try {
    require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'autoloader.php');
    \Framework\Logger\Logger::Access('Access to ' . $service);

    $controllerClass = ('\App\Controller\\' . $service . 'Controller');
    $controllerObj   = new $controllerClass();
    echo($controllerObj->run());
    \Framework\Logger\Logger::Success('Successfully called ' . $service);
}
catch(\Exception $e) {
    $errorMsg = ('Failed to call ' . $service . ' - ' . $e->getMessage());
    \Framework\Logger\Logger::Error($errorMsg);
    echo(\Framework\Helper\JSON::Encode($errorMsg));
}