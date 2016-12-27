<?php

namespace idOS\Section;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;

class Profile extends AbstractSection {
    /**
     * The profile userName.
     */
    private $userName;

    /**
     * Constructor Class.
     *
     * @param string                   $userName
     * @param \idOS\Auth\AuthInterface $authentication
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
        $this->userName = $userName;
        parent::__construct($authentication, $client, $throwsExceptions, $baseUrl);
    }

    /**
     * Return an endpoint instance properly initialized.
     *
     * @param string $name
     *
     * @return \idOS\Endpoint\EndpointInterface
     */
    public function __get($name) {
        return $this->createEndpoint($name, [$this->userName]);
    }

    /**
     * Return a section instance properly initialized.
     *
     * @param string $name
     * @param array  $args
     *
     * @return \idOS\Section\SectionInterface
     */
    public function __call($name, array $args) {
        $args[] = $this->userName;
        return $this->createSection($name, $args);
    }
}
