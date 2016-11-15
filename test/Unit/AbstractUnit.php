<?php

namespace Test\Unit;

/**
 * Abstract Class (Base for all unit tests).
 */
abstract class AbstractUnit extends \PHPUnit_Framework_TestCase {
    protected $sdk;
    protected $auth;
    protected $credentials;

    protected function setUp() {
        /**
         * Saves into the credentials variable all credentials necessary for testing the endpoints.
         */
        $this->credentials = [
            'credentialPublicKey' => 'credentialPublicKey',
            'credentialPrivKey'   => 'credentialPrivKey',
            'handlerPublicKey'    => 'handlerPublicKey',
            'handlerPrivKey'      => 'handlerPrivKey',
            'userName'            => 'userName'
        ];
    }

    /**
     * Invokes private and protected methods.
     *
     * @param object &$object    the instance of the object
     * @param string $method     the name of the method to be invoked
     * @param array  $parameters the method parameters
     *
     * @return the method result.
     */
    protected function invokeMethod(&$object, $method, array $parameters = []) {
        $reflection = new \ReflectionClass(get_class($object));
        $method     = $reflection->getMethod($method);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

    /**
     * Sets a value for a private property.
     *
     * @param object $object   the instance of the object
     * @param string $property the name of the property
     * @param $value the vaue of the property
     */
    protected function setPropertyValue($object, $property, $value) {
        $reflection = new \ReflectionClass($object);
        $property   = $reflection->getProperty($property);
        $property->setAccessible(true);
        $property->setValue($object, $value);
    }

    /**
     * Returns the value of a private property.
     *
     * @param object $object   the instance of the object
     * @param string $property the name of the property
     *
     * @return the value of the property
     */
    protected function getPropertyValue($object, $property) {
        $reflection = new \ReflectionClass($object);
        $property   = $reflection->getProperty($property);
        $property->setAccessible(true);

        return $property->getValue($object);
    }
}
