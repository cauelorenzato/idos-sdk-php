<?php

namespace Test\Functional\Endpoint\Profile;

use Test\Functional\AbstractFunctional;

class ProcessesTest extends AbstractFunctional {
    protected function setUp() {
        parent::setUp();
    }

    public function testListAll() {
        $this->sdk->setBaseUrl('http://localhost:8000');
        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Processes->listAll();

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
       
        foreach ($response['data'] as $process) {
            $this->assertInternalType('integer', $process['id']);
            $this->assertInternalType('string', $process['name']);
            $this->assertInternalType('string', $process['event']);
            $this->assertInternalType('integer', $process['created_at']);
        }
    }

    public function testGetOne() {
        $processes = $this->sdk
            ->Profile($this->credentials['username'])
            ->Processes->listAll();
            
        $response = $this->sdk
            ->Profile($this->credentials['username'])
            ->Processes->getOne($processes['data'][0]['id']);

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertSame($processes['data'][0]['id'], $response['data']['id']);
        $this->assertSame('Some random process for the user', $response['data']['name']);
        $this->assertSame('idos:source.sms.verified', $response['data']['event']);
        $this->assertInternalType('integer', $response['data']['created_at']);
    }
}
