<?php

namespace Test\Unit\idOS\Endpoint\Profile;

use Test\Unit\idOS\AbstractUnitTest;
use idOS\Endpoint\Profile\Candidates;
/**
 * CandidatesTest Class tests all methods from the Candidates Class.
 */
class CandidatesTest extends AbstractUnitTest {
	/**
     * $candidates object instantiates the Candidates Class.
     */
    protected $candidates;

    protected function setUp() {
        parent::setUp();

        /**
         * GuzzleHttp\Client mock.
         */
        $this->httpClient = $this
            ->getMockBuilder('GuzzleHttp\Client')
            ->getMock();

        /**
         * CredentialToken instance to instantiate the idOS\SDK Class.
         */
        $this->auth = new \idOS\Auth\CredentialToken(
            $this->credentials['credentialPublicKey'],
		    $this->credentials['handlerPublicKey'],
		    $this->credentials['handlerPrivKey']
		);

        $this->candidates = new Candidates('dummyUserName', $this->auth, $this->httpClient, false);
    }

    public function testListAll() {
        /**
         * Array response from the fake api call to Candidates endpoint.
         */
        $array = [
            'status' => true,
            'data' => [
                0 => [
                    'attribute' => 'firstName',
                    'value' => 'Jhon',
                    'support' => 0.6,
                    'created_at' => time(),
                    'updated_at' => time()
                ],
                1 => [
                  	'attribute' => 'lastName',
                    'value' => 'Doe',
                    'support' => 0.7,
                    'created_at' => time(),
                    'updated_at' => time()
                ],
                2 => [
                	'attribute' => 'gender',
                	'value' => 'male',
                	'support' => 0.8,
                	'created_at' => time(),
                    'updated_at' => time()
                ]
            ]
        ];

        /**
         * Mocks the HTTP Response
         */
        $this->httpResponse = $this
            ->getMockBuilder('GuzzleHttp\Psr7\Response')
            ->getMock();
        $this->httpResponse
            ->method('getBody')
            ->will($this->returnValue(json_encode($array)));
        $this->httpClient
            ->method('request')
            ->will($this->returnValue($this->httpResponse));

        /**
         * Calls the listAll() method.
         */
        $response = $this->candidates->listAll();

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        foreach ($response['data'] as $candidate) {
        	$this->assertArrayHasKey('attribute', $candidate);
        	$this->assertArrayHasKey('value', $candidate);
        	$this->assertArrayHasKey('support', $candidate);
    	}
    }

    public function testCreateNew() {
    	/**
         * Array response from the fake api call to Candidates endpoint.
         */
        $array = [
            'status' => true,
            'data' => [
                'attribute' => 'firstName',
                'value' => 'Jhon',
                'support' => 0.6,
                'created_at' => time(),
                'updated_at' => time()
            ]
        ];

        /**
         * Mocks the HTTP Response
         */
        $this->httpResponse = $this
            ->getMockBuilder('GuzzleHttp\Psr7\Response')
            ->getMock();
        $this->httpResponse
            ->method('getBody')
            ->will($this->returnValue(json_encode($array)));
        $this->httpClient
            ->method('request')
            ->will($this->returnValue($this->httpResponse));

        /**
         * Calls the createNew() method.
         */
        $response = $this->candidates->createNew('firstName', 'Jhon', 0.6);

        $this->assertTrue($response['status']);
        $this->assertNotEmpty($response['data']);
        $this->assertArrayHasKey('attribute', $response['data']);
        $this->assertSame($response['data']['attribute'], $array['data']['attribute']);
        $this->assertArrayHasKey('value', $response['data']);
        $this->assertSame($response['data']['value'], $array['data']['value']);
        $this->assertArrayHasKey('support', $response['data']);
        $this->assertSame($response['data']['support'], $array['data']['support']);
        $this->assertTrue(is_int($response['data']['created_at']));
        $this->assertTrue(is_int($response['data']['updated_at']));
    }

    /**
     * @expectedException TypeError
     */
    public function testCreateNewInvalidParameters() {
        /**
         * Calls the createNew() method.
         */
        $response = $this->candidates->createNew('firstName', 'Jhon', 'invalidSupportValue');
    }

    public function testDeleteAll() {
    	/**
         * Array response from the fake api call to Candidates endpoint.
         */
        $array = [
            'status' => true,
            'deleted' => 2
        ];

        /**
         * Mocks the HTTP Response
         */
        $this->httpResponse = $this
            ->getMockBuilder('GuzzleHttp\Psr7\Response')
            ->getMock();
        $this->httpResponse
            ->method('getBody')
            ->will($this->returnValue(json_encode($array)));
        $this->httpClient
            ->method('request')
            ->will($this->returnValue($this->httpResponse));

        $response = $this->candidates->deleteAll();

        $this->assertTrue($response['status']);
        $this->assertArrayHasKey('deleted', $response);
        $this->assertEquals(2, $response['deleted']);
    }
}