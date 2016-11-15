<?php

namespace idOS\Endpoint\Profile;

/**
 * Attribute Class Endpoint.
 */
class Attributes extends AbstractProfileEndpoint {
    /**
     * Lists all attributes.
     *
     * @param array $filter
     *
     * @return array Response
     */
    public function listAll(array $filter = []) {
        return $this->sendGet(
            sprintf('/profiles/%s/attributes', $this->userName),
            $filter
        );
    }

    /**
     * Retrieves an attribute given its slug.
     *
     * @param string $attributeName
     *
     * @return array Response
     */
    public function getOne($attributeName) {
        assert(
            is_string($attributeName),
            new \RuntimeException(
                sprintf('Parameter "$attributeName" should be a string. (%s)', $attributeName)
            )
        );

        return $this->sendGet(
            sprintf('/profiles/%s/attributes/%s', $this->userName, $attributeName)
        );
    }
}
