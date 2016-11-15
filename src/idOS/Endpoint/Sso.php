<?php

namespace idOS\Endpoint;
/**
 * Single Sign-On Class Endpoint.
 */
class Sso extends AbstractEndpoint {
    /**
     * Creates a new SSO.
     *
     * @param string $providerName
     * @param string $credentialPubKey
     * @param string $accessToken
     * @param string $tokenSecret
     */
    public function createNew(
        $providerName,
        $credentialPubKey,
        $accessToken,
        $tokenSecret = '',
        $signupHash = ''
    ) {
        assert(
            is_string($providerName),
            new \RuntimeException(
                sprintf('Parameter "$providerName" should be a string. (%s)', $providerName)
            )
        );
        assert(
            is_string($credentialPubKey),
            new \RuntimeException(
                sprintf('Parameter "$credentialPubKey" should be a string. (%s)', $credentialPubKey)
            )
        );
        assert(
            is_string($accessToken),
            new \RuntimeException(
                sprintf('Parameter "$accessToken" should be a string. (%s)', $accessToken)
            )
        );

        $array = [
            'provider'     => $providerName,
            'access_token' => $accessToken,
            'credential'   => $credentialPubKey
        ];

        if (! empty($tokenSecret)) {
            assert(
                is_string($tokenSecret),
                new \RuntimeException(
                    sprintf('Parameter "$tokenSecret" should be a string. (%s)', $tokenSecret)
                )
            );
            $array['token_secret'] = $tokenSecret;
        }

        if (! empty($signupHash)) {
            assert(
                is_string($signupHash),
                new \RuntimeException(
                    sprintf('Parameter "$signupHash" should be a string. (%s)', $signupHash)
                )
            );
            $array['signup_hash'] = $signupHash;
        }

        return $this->sendPost(
            '/sso',
            [],
            $array
        );
    }

    /**
     * Lists all SSO.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function listAll(array $filters = []) {
        return $this->sendGet(
            '/sso',
            $filters
        );
    }

    /**
     * Retrieves a providerName SSO availability status.
     *
     * @param string $providerName
     *
     * @return array Response
     */
    public function getOne($providerName) {
        assert(
            is_string($providerName),
            new \RuntimeException(
                sprintf('Parameter "$providerName" should be a string. (%s)', $providerName)
            )
        );

        return $this->sendGet(
            sprintf('/sso/%s', $providerName)
        );
    }
}
