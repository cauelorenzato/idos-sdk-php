<?php

namespace idOS\Endpoint\Profile;

/**
 * Candidate Class Endpoint.
 */
class Candidates extends AbstractProfileEndpoint {
    /**
     * Lists all attribute candidates.
     *
     * @param array $filter
     *
     * @return array Response
     */
    public function listAll($filter = []) {
        return $this->sendGet(
            sprintf('/profiles/%s/candidates', $this->userName),
            $filter
        );
    }

    /**
     * Creates a new attribute candidate for the given user.
     *
     * @param string $attribute
     * @param string $value
     * @param float  $support
     *
     * @return array Response
     */
    public function createNew(
        $attribute,
        $value,
        $support
    ) {
        assert(
            is_string($attribute),
            new \RuntimeException(
                sprintf('Parameter "$attribute" should be a string. (%s)', $attribute)
            )
        );
        assert(
            is_string($value),
            new \RuntimeException(
                sprintf('Parameter "$value" should be a string. (%s)', $value)
            )
        );
        assert(
            is_float($support),
            new \RuntimeException(
                sprintf('Parameter "$support" should be a float. (%s)', $support)
            )
        );

        return $this->sendPost(
            sprintf('/profiles/%s/candidates', $this->userName),
            [],
            [
                'attribute' => $attribute,
                'value'     => $value,
                'support'   => $support
            ]
        );
    }

    /**
     * Deletes all attribute candidates.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function deleteAll($filters = []) {
        return $this->sendDelete(
            sprintf('/profiles/%s/candidates', $this->userName),
            $filters
        );
    }
}
