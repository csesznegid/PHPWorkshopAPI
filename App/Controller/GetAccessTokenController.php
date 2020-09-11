<?php

/**
 * This file is part of the "PHP Workshop - API" package
 *
 * @author Denes Csesznegi
 * @since  2020.09.10.
 */

namespace App\Controller;

use Framework\Authentication\TokenGenerator;
use Framework\Database\Query;
use Framework\Response\JSONResponse;
use Framework\SuperGlobal\Server;

/**
 * Class GetAccessTokenController
 *
 * @package App\Controller
 */
class GetAccessTokenController extends BaseController
{
    /**
     * {@inheritDoc}
     */
    public function run()
    {
        $this->methodFilter('GET');
        $this->ipFilter();

        $db      = $this->getDatabaseConnection();
        $token   = TokenGenerator::Generate(128, time());
        $validTo = (new \DateTime('now'))->modify('+' . parent::$config->token_valid_to);
        Query::Insert($db, 'token_authentication', array(
            'token'       => $token,
            'client_ip'   => (Server::Has('REMOTE_ADDR') ? Server::Get('REMOTE_ADDR') : null),
            'expire_date' => $validTo->format('Y-m-d H:i:s'),
        ));

        return new JSONResponse($token);
    }
}