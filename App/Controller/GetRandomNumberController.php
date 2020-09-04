<?php

namespace App\Controller;

use Framework\Response\JSONResponse;
use Framework\SuperGlobal\Request;

class GetRandomNumberController extends BaseController
{
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