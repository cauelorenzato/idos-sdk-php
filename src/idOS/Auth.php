<?php

namespace idOS;

class Auth {
    /**
     * @const CREDENTIAL
     */
    const CREDENTIAL = 0x01;

    /**
     * @const CREDENTIAL
     */
    const HANDLER = 0x02;

    /**
     * @const IDENTITY
     */
    const IDENTITY = 0x03;

    /**
     * Public Key (handler, credential).
     */
    private $publicKey;
    /**
     * Private Key (handler, credential).
     */
    private $privateKey;
    /**
     * The authorization type (Identity, Credential, User).
     */
    private $authType;
    /**
     * The user token.
     */
    private $userToken = [];
    /**
     * The credential token.
     */
    private $credentialToken;
    /**
     * The identity token.
     */
    private $identityToken;
    /**
     * The handler token.
     */
    private $handlerToken;

    /**
     * Constructor Class.
     *
     * @param string $publicKey
     * @param string $privateKey
     * @param int    $authType
     */
    public function __construct(
        $publicKey,
        $privateKey,
        $authType
    ) {
        $this->publicKey  = $publicKey;
        $this->privateKey = $privateKey;
        $this->authType   = $authType;
    }

    /**
     * Setter to store the public key.
     *
     * @param string $publicKey
     */
    public function setPublicKey($publicKey) {
        $this->publicKey = $publicKey;

        return $this;
    }

    /**
     * Getter to return the public key.
     *
     * @return string publicKey
     */
    public function getPublicKey() {
        return $this->publicKey;
    }

    /**
     * Setter to store the private key.
     *
     * @param string $privateKey
     */
    public function setPrivateKey($privateKey) {
        $this->privateKey = $privateKey;

        return $this;
    }

    /**
     * Getter to return the private key.
     *
     * @return string privateKey
     */
    public function getPrivateKey() {
        return $this->privateKey;
    }

    /**
     * Sets the authorization type.
     *
     * @param int $authType
     */
    public function setAuthType($authType) {
        $this->authType = $authType;

        return $this;
    }

    /**
     * Returnts the authorization type.
     *
     * @return int authType
     */
    public function getAuthType() {
        return $this->authType;
    }

    /**
     * Returns the user token.
     *
     * @param string $userName
     *
     * @return string userToken
     */
    public function getUserToken($userName) {
        if (isset($this->userToken[$userName])) {
            return $this->userToken[$userName];
        }
    }

    /**
     * Returns the credential token.
     *
     * @return string credentialToken
     */
    public function getCredentialToken() {
        return $this->credentialToken;
    }

    /**
     * Sets the identity token.
     *
     * @param string $token
     */
    public function setIdentityToken($token) {
        $this->identityToken = $token;

        return $this;
    }

    /**
     * Returns the handler token.
     *
     * @return string handlerToken
     */
    public function getHandlerToken() {
        return $this->handlerToken;
    }

    /**
     * Returns the identity token.
     *
     * @return string identityToken
     */
    public function getIdentityToken() {
        return $this->identityToken;
    }

    /**
     * Gets the Authorization header related to the authType.
     *
     * @return string header
     */
    public function getHeader() {
        switch ($this->authType) {
            case self::CREDENTIAL:
                return sprintf('CredentialToken %s', $this->getCredentialToken());
            case self::HANDLER:
                return sprintf('HandlerToken %s', $this->getHandlerToken());
            case self::IDENTITY:
                return sprintf('IdentityToken %s', $this->getIdentityToken());
        }
    }

    /**
     * Gets the Authorization related to the authType and transforms it to a query parameter.
     *
     * @return string query
     */
    public function getQuery() {
        switch ($this->authType) {
            case self::CREDENTIAL:
                return sprintf('credentialToken=%s', $this->getCredentialToken());
            case self::HANDLER:
                return sprintf('handlerToken=%s', $this->getHandlerToken());
            case self::IDENTITY:
                return sprintf('identityToken=%s', $this->getIdentityToken());
        }
    }
}
