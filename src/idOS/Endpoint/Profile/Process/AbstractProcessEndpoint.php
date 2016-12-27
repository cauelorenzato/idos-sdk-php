<?php

namespace idOS\Endpoint\Profile\Process;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;
use idOS\Endpoint\AbstractEndpoint;

abstract class AbstractProcessEndpoint extends AbstractEndpoint {
    protected $processId;
    protected $userName;

    /**
     * Constructor Class.
     *
     * @param int           $processId        The process' id
     * @param AuthInterface $authentication   The type of the authentication: UserToken, HandlerToken and IdentityToken
     * @param Client        $client
     * @param bool|bool     $throwsExceptions
     * @param string        $baseUrl
     */
    public function __construct(
        $processId,
        $userName,
        AuthInterface $authentication,
        Client $client,
        $throwsExceptions,
		$baseUrl
    ) {
        if (is_null($throwsExceptions))
            $throwsExceptions = false;

        if (is_null($baseUrl))
            $baseUrl = 'https://api.idos.io/1.0/';
        
        $this->processId = $processId;
        $this->userName  = $userName;
        parent::__construct($authentication, $client, $throwsExceptions, $baseUrl);
    }
}
