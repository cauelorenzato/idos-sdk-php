<?php

namespace idOS\Endpoint\Profile;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;
use idOS\Endpoint\AbstractEndpoint;

abstract class AbstractProfileEndpoint extends AbstractEndpoint {
    /**
     * The username to be stored and used in all /profiles endpoints.
     */
    protected $userName;

    /**
     * Constructor Class.
     *
     * @param string        $userName         The user username
     * @param AuthInterface $authentication   The type of the authentication: UserToken, HandlerToken and IdentityToken
     * @param Client        $client
     * @param bool|bool     $throwsExceptions
     */
    public function __construct(
        $userName,
        AuthInterface $authentication,
        Client $client,
        $throwsExceptions = false
    ) {
        $this->userName = $userName;
        parent::__construct($authentication, $client, $throwsExceptions);
    }
}
