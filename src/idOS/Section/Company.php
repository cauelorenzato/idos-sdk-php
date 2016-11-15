<?php

namespace idOS\Section;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;
use idOS\Endpoint\EndpointInterface;

class Company extends AbstractSection {
    /**
     * The company slug.
     */
    private $companySlug;

    /**
     * Constructor Class.
     *
     * @param string        $companySlug
     * @param AuthInterface $authentication
     * @param Client        $client
     * @param bool|bool     $throwsExceptions
     */
    public function __construct(
        $companySlug,
        $authentication,
        $client,
        $throwsExceptions = false
    ) {
        $this->companySlug = $companySlug;
        parent::__construct($authentication, $client, $throwsExceptions);
    }

    /**
     * returns the endpoint called passing the process id inside constructor.
     *
     * @param string $name
     *
     * @return endpoint instance
     */
    public function __get($name) {
        $className = $this->getEndpointClassName($name);

        return new $className(
            $this->companySlug,
            $this->authentication,
            $this->client
        );
    }

    /**
     * returns the endpoint called.
     *
     * @param string $name
     * @param array  $args
     *
     * @return endpoint instance
     */
    public function __call($name, $args) {
        $className = $this->getSectionClassName($name);
        $args[]    = $this->companySlug;
        $args[]    = $this->authentication;
        $args[]    = $this->client;

        return new $className(...$args);
    }
}
