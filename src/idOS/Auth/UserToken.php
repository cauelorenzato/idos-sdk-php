<?php

namespace idOS\Auth;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;

class UserToken extends AbstractAuth {
    /**
     * The userName.
     */
    private $userName;
    /**
     * The credential public key.
     */
    private $credentialPublicKey;
    /**
     * The credential private key.
     */
    private $credentialPrivateKey;
    /**
     * The generated token.
     */
    private $token;

    /**
     * Constructor Class.
     *
     * @param string $userName
     * @param string $credentialPublicKey
     * @param string $credentialPrivateKey
     */
    public function __construct(
        $userName,
        $credentialPublicKey,
        $credentialPrivateKey
    ) {
        $this->userName             = $userName;
        $this->credentialPublicKey  = $credentialPublicKey;
        $this->credentialPrivateKey = $credentialPrivateKey;
    }

    /**
     * Generates the User Token and returns it.
     *
     * @return string userToken
     */
    public function getToken() {
        if (($this->token === null) || ($this->token->isExpired())) {
            $jwtBuilder = new Builder();
            $jwtBuilder->set('iss', $this->credentialPublicKey);
            $jwtBuilder->set('sub', $this->userName);

            $this->token = $jwtBuilder
                ->sign(new Sha256(), $this->credentialPrivateKey)
                ->getToken();
        }

        return (string) $this->token;
    }
}
