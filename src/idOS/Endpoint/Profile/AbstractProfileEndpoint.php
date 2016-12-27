<?php

namespace idOS\Endpoint\Profile;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;
use idOS\Endpoint\AbstractEndpoint;

abstract class AbstractProfileEndpoint extends AbstractEndpoint {
    /**
     * The username to be stored and used in all /profiles endpoints.
     *
     * @var string
     */
    protected $userName;

    /**
     * Constructor Class.
     *
     * @param string                   $userName         The user username
     * @param \idOS\Auth\AuthInterface $authentication   The type of the authentication: UserToken, HandlerToken and IdentityToken
     * @param \GuzzleHttp\Client       $client
     * @param bool                     $throwsExceptions
     * @param string                   $baseUrl
     *
     * @return void
     */
    public function __construct(
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

        $this->userName = $userName;
        parent::__construct($authentication, $client, $throwsExceptions, $baseUrl);
    }
}
