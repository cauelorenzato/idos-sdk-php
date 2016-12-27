<?php

namespace idOS\Section;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;
use idOS\Endpoint\EndpointInterface;

abstract class AbstractSection implements SectionInterface {
	/**
     * Authentication type (User, Credential, Identity).
     *
     * @var \idOS\Auth\AuthInterface
     */
    protected $authentication;
    /**
     * GuzzeHTTP\Client.
     *
     * @var \GuzzleHttp\Client
     */
    protected $client;
    /**
     * Boolean option to throw exception or not.
     *
     * @var bool
     */
    protected $throwsExceptions;
    /**
     * idOS API base URL.
     *
     * @var string
     */
    protected $baseUrl;

    /**
     * Return the Endpoint Class Name.
     *
     * @param string $name
     *
     * @return string $className
     */
    protected function getEndpointClassName($name) {
        $className = sprintf(
            '%s\\%s',
            str_replace('Section', 'Endpoint', get_class($this)),
            ucfirst($name)
        );

        if (! class_exists($className)) {
            throw new \RuntimeException(
                sprintf(
                    'Invalid endpoint name "%s" (%s)',
                    $name,
                    $className
                )
            );
        }

        return $className;
    }

	/**
     * Return an endpoint instance properly initialized.
     *
     * @param string $name
     * @param array  $argsw
     *
     * @return \idOS\Endpoint\EndpointInterface
     */
    protected function createEndpoint($name, array $args) {
        $className = $this->getEndpointClassName($name);

        // aditional parameters
        $args[] = $this->authentication;
        $args[] = $this->client;
        $args[] = $this->throwsExceptions;
        $args[] = $this->baseUrl;

        return new $className($args[0], $args[1], $args[2], $args[3], $args[4]);
    }

    /**
     * Returns the Section Class Name.
     *
     * @param string $name
     *
     * @return string $className
     */
    protected function getSectionClassName($name) {
        $className = sprintf(
            '%s\\%s',
            get_class($this),
            ucfirst($name)
        );

        if (! class_exists($className)) {
            throw new \RuntimeException(
                sprintf(
                    'Invalid section name "%s" (%s)',
                    $name,
                    $className
                )
            );
        }
        
        return $className;
    }

     /**
     * Return a section instance properly initialized.
     *
     * @param string $name
     * @param array  $args
     *
     * @return \idOS\Section\SectionInterface
     */
    protected function createSection($name, $authentication, $client, $throwsExceptions, $baseUrl) {
        $className = $this->getSectionClassName($name);
        return new $className($authentication, $client, $throwsExceptions, $baseUrl);
    }

    /**
     * Constructor Class.
     *
     * @param \idOS\Auth\AuthInterface $authentication
     * @param \GuzzleHttp\Client        $client
     * @param bool          $throwsExceptions
     * @param string        $baseUrl
     *
     * @return void
     */
    public function __construct(
        AuthInterface $authentication,
        Client $client,
        $throwsExceptions,
        $baseUrl
    ) {        
        if (is_null($throwsExceptions))
            $throwsExceptions = false;

        if (is_null($baseUrl))
            $baseUrl = 'https://api.idos.io/1.0/';

        $this->authentication   = $authentication;
        $this->client           = $client;
        $this->throwsExceptions = $throwsExceptions;
        $this->baseUrl          = $baseUrl;
    }
}
