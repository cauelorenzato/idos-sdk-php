<?php

namespace idOS\Section\Profile;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;
use idOS\Section\AbstractSection;

class Process extends AbstractSection {
    /**
     * The process id necessary for all /process base endpoint.
     */
    private $processId;

    /**
     * Constructor Class.
     *
     * @param int           $processId
     * @param string        $userName
     * @param AuthInterface $authentication
     * @param Client        $client
     * @param bool|bool     $throwsExceptions
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
            $this->processId,
            $this->userName,
            $this->authentication,
            $this->client, 
            $this->throwsExceptions,
            $this->baseUrl
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
    public function __call($name, array $args) {
        $className = $this->getSectionClassName($name);
        $args[]    = $this->processId;
        $args[]    = $this->userName;
        $args[]    = $this->authentication;
        $args[]    = $this->client;

        return new $className($args[0], $args[1], $args[2], $args[3]);
    }
}
