<?php

/**
 * This file is part of the "PHP Workshop - API" package
 *
 * @author Denes Csesznegi
 * @since  2020.09.03.
 */

namespace App\Controller;

/**
 * Interface for the controllers (services)
 *
 * @package App\Controller
 */
interface IController
{
    /**
     * Run the service
     *
     * @return \Framework\Response\JSONResponse|string Data as JSON
     * @access public
     */
    public function run();
}