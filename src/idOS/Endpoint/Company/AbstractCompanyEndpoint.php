<?php

namespace idOS\Endpoint\Company;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;
use idOS\Endpoint\AbstractEndpoint;

abstract class AbstractCompanyEndpoint extends AbstractEndpoint {
    protected $companySlug;

    /**
     * Constructor Class.
     *
     * @param string        $companySlug      The company's slug
     * @param AuthInterface $authentication   The type of the authentication: UserToken, HandlerToken and IdentityToken
     * @param Client        $client
     * @param bool|bool     $throwsExceptions
     */
    public function __construct(
        string $companySlug,
        AuthInterface $authentication,
        Client $client,
        bool $throwsExceptions = false
    ) {
        $this->companySlug = $companySlug;
        parent::__construct($authentication, $client, $throwsExceptions);
    }
}
