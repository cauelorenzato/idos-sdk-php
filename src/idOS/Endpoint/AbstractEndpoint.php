<?php

namespace idOS\Endpoint;

use GuzzleHttp\Client;
use idOS\Auth\AuthInterface;
use idOS\Exception\SDKError;
use idOS\Exception\SDKException;

abstract class AbstractEndpoint implements EndpointInterface {
    /**
     * The Authentication type (UserToken, CredentialToken, IdentityToken).
     */
    protected $authentication;
    /**
     * GuzzleHttp\Client.
     */
    protected $client;
    /**
     * Boolean option to throw exception.
     */
    protected $throwExceptions;

    /**
     * Sends the request to the api.
     *
     * @param string $method
     * @param array  $query
     * @param array  $body
     *
     * @return array response
     */
    private function sendRequest($method, $uri, array $query = [], array $body = []) {
        $uri = sprintf('https://api.idos.io/1.0/%s', ltrim($uri, '/'));

        $options = [
            'headers' => [
                'Authorization' => (string) $this->authentication
            ],
            'http_errors' => false
        ];

        if (! empty($query)) {
            $options['query'] = $query;
        }

        if (! empty($body)) {
            $options['json'] = $body;
        }

        $response = $this->client->request(
            $method,
            $uri,
            $options
        );

        $json = json_decode((string) $response->getBody(), true);
        if ($json === null) {
            if ($this->throwExceptions) {
                throw new SDKError();
            }

            return [(string) $response->getBody()];
        }

        if ((! $json['status']) && ($this->throwExceptions)) {
            throw new SDKException(
                $json['error']['message'],
                $json['error']['type'],
                $json['error']['link']
            );
        }

        return $json;
    }

    /**
     * Sends GET request.
     *
     * @param string $uri
     * @param array  $query
     *
     * @return array response
     */
    protected function sendGet($uri, array $query = []) {
        return $this->sendRequest(
            'GET',
            $uri,
            $query,
            []
        );
    }

    /**
     * Sends a POST request.
     *
     * @param string $uri
     * @param array  $query
     * @param array  $body
     *
     * @return array response
     */
    protected function sendPost($uri, array $query = [], array $body = []) {
        return $this->sendRequest(
            'POST',
            $uri,
            $query,
            $body
        );
    }

    /**
     * Sends a PATCH request.
     *
     * @param string $uri
     * @param array  $query
     * @param array  $body
     *
     * @return array response
     */
    protected function sendPatch($uri, array $query = [], array $body = []) {
        return $this->sendRequest(
            'PATCH',
            $uri,
            $query,
            $body
        );
    }

    /**
     * Sends a PUT request.
     *
     * @param string $uri
     * @param array  $query
     * @param array  $body
     *
     * @return array response
     */
    protected function sendPut($uri, array $query = [], array $body = []) {
        return $this->sendRequest(
            'PUT',
            $uri,
            $query,
            $body
        );
    }

    /**
     * Sends a DELETE request.
     *
     * @param string $uri
     * @param array  $query
     *
     * @return array response
     */
    protected function sendDelete($uri, array $query = []) {
        return $this->sendRequest(
            'DELETE',
            $uri,
            $query,
            []
        );
    }

    /**
     * Constructor Class.
     *
     * @param AuthInterface $authentication
     * @param Client        $client
     * @param bool|bool     $throwExceptions
     */
    public function __construct(
        AuthInterface $authentication,
        Client $client,
        $throwExceptions = false
    ) {
        $this->authentication  = $authentication;
        $this->client          = $client;
        $this->throwExceptions = $throwExceptions;
    }
}
