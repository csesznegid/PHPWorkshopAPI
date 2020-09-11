<?php

/**
 * This file is part of the "PHP Workshop - API" package
 *
 * @author Denes Csesznegi
 * @since  2020.09.10.
 */

namespace App\Controller;

use Framework\Response\JSONResponse;

/**
 * Get currencies from MNB
 *
 * @package App\Controller
 */
class GetCurrenciesController extends BaseController
{
    /**
     * {@inheritDoc}
     */
    public function run()
    {
        $this->methodFilter('GET');

        $client           = new \SoapClient(parent::$config->mnb_soap_url);
        $currenciesXML    = $client->GetCurrencies()->GetCurrenciesResult;
        $currenciesParsed = simplexml_load_string($currenciesXML);

        if (false === $currenciesParsed) {
            throw new \Exception('Failed to parse XML.');
        }

        return new JSONResponse($currenciesParsed->Currencies->Curr);
    }
}