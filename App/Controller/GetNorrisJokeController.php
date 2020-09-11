<?php

/**
 * This file is part of the "PHP Workshop - API" package
 *
 * @author Denes Csesznegi
 * @since  2020.09.10.
 */

namespace App\Controller;

/**
 * Get Chuck Norris joke
 *
 * @package App\Controller
 */
class GetNorrisJokeController extends BaseController
{
    /**
     * {@inheritDoc}
     */
    public function run()
    {
        $this->methodFilter('GET');

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL            => parent::$config->norris_joke_url,
            CURLOPT_POST           => false,
            CURLOPT_RETURNTRANSFER => true,
        ));
        $curlResponse = curl_exec($curl);

        if (curl_errno($curl)) {
            throw new \Exception(curl_error($curl), curl_errno($curl));
        }

        return $curlResponse;
    }
}