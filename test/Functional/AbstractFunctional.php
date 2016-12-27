<?php

namespace Test\Functional;

abstract class AbstractFunctional extends \PHPUnit_Framework_TestCase {
    protected $sdk;
    protected $credentials;
    protected $baseUrl;

    protected function setUp() {
        if (! $this->credentials) {
            $this->credentials = require __DIR__ . '/../../settings.php';
        }
        
        $this->baseUrl = 'http://localhost:8000/index.php/1.0';

        if (! $this->sdk) {
            $auth      = new \idOS\Auth\CredentialToken($this->credentials['credentialPublicKey'], $this->credentials['handlerPublicKey'], $this->credentials['handlerPrivKey']);
            $this->sdk = \idOS\SDK::create($auth, false, $this->baseUrl);
        }
    }
}
