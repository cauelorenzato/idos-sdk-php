<?php

namespace idOS\Auth;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;

/**
 * Credential Token Class that generates the Credential token.
 */
class CredentialToken extends AbstractAuth {
    /**
     * The credential Public Key.
     */
    private $credentialPublicKey;
    /**
     * The handler Public Key.
     */
    private $handlerPublicKey;
    /**
     * The handler Private Key.
     */
    private $handlerPrivateKey;
    /**
     * The generated token.
     */
    private $token;

    /**
     * Constructor Class.
     *
     * @param string $credentialPublicKey
     * @param string $handlerPublicKey
     * @param string $handlerPrivateKey
     */
    public function __construct(
        $credentialPublicKey,
        $handlerPublicKey,
        $handlerPrivateKey
    ) {
        $this->credentialPublicKey = $credentialPublicKey;
        $this->handlerPublicKey    = $handlerPublicKey;
        $this->handlerPrivateKey   = $handlerPrivateKey;
    }

    /**
     * Generates the credential token and returns it.
     *
     * @return string credentialToken
     */
    public function getToken() {
        if (($this->token === null) || ($this->token->isExpired())) {
            $jwtBuilder = new Builder();
            $jwtBuilder->set('iss', $this->handlerPublicKey);
            $jwtBuilder->set('sub', $this->credentialPublicKey);

            $this->token = $jwtBuilder
                ->sign(new Sha256(), $this->handlerPrivateKey)
                ->getToken();
        }

        return (string) $this->token;
    }
}
