<?php

/**
 * This file is part of the "PHP Workshop - API" package
 *
 * @author Denes Csesznegi
 * @since  2020.09.03.
 */

namespace App\Controller;

use Framework\Response\JSONResponse;
use Framework\SuperGlobal\Request;

/**
 * Service controller to get a random number
 *
 * @package App\Controller
 */
class GetRandomNumberController extends BaseController
{
    /**
     * {@inheritDoc}
     */
    public function run()
    {
        $this->methodFilter('GET');
        $this->ipFilter();
        $this->osFilter();

        $min = (Request::Has('min') ? Request::GetInt('min') : 0);
        $max = (Request::Has('max') ? Request::GetInt('max') : PHP_INT_MAX);

        return new JSONResponse(rand($min, $max));
    }
}