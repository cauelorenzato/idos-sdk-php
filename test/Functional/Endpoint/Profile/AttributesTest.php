<?php

namespace Test\Functional\Endpoint\Profile;

use Test\Functional\AbstractFunctional;

class AttributesTest extends AbstractFunctional {

    protected function setUp() {
        parent::setUp();
    }

    public function testListAll() {
    	$this->sdk
            ->Profile($this->credentials['username'])
            ->Candidates->createNew('email', 'jhon@jhon.com', 0.9);
    	$this->sdk
            ->Profile($this->credentials['username'])
            ->Candidates->createNew('gender', 'male', 0.9);

        $auth = new \idOS\Auth\UserToken($this->credentials['username'], $this->credentials['credentialPublicKey'], $this->credentials['credentialPrivKey']);
        $this->sdk = \idOS\SDK::create($auth);

        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Attributes->listAll();

        foreach ($response['data'] as $attribute) {
            $this->assertArrayHasKey('name', $attribute);
            $this->assertArrayHasKey('value', $attribute);

            if(isset($attribute['name'])) {
            	if ($attribute['name'] === 'email') {
            		$this->assertSame('jhon@jhon.com', $attribute['value']);
            	}

            	if ($attribute['name'] === 'gender') {
            		$this->assertSame('male', $attribute['value']);
            	}
            }
        }
    }
}
