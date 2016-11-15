<?php

namespace idOS\Endpoint\Profile;

/**
 * References Class Endpoint.
 */
class References extends AbstractProfileEndpoint {
    /**
     * Creates a new reference for the given user.
     *
     * @param string $name
     * @param string $value
     *
     * @return array Response
     */
    public function createNew(
        $name,
        $value
    ) {
        assert(
            is_string($name),
            new \RuntimeException(
                sprintf('Parameter "$name" should be a string. (%s)', $name)
            )
        );
        assert(
            is_string($value),
            new \RuntimeException(
                sprintf('Parameter "$value" should be a string. (%s)', $value)
            )
        );

        return $this->sendPost(
            sprintf('/profiles/%s/references', $this->userName),
            [],
            [
                'name'      => $name,
                'value'     => $value
            ]
        );
    }

    /**
     * Lists all references.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function listAll(array $filters = []) {
        return $this->sendGet(
            sprintf('/profiles/%s/references', $this->userName),
            $filters
        );
    }

    /**
     * Retrieves a reference given its slug.
     *
     * @param string $referenceName
     *
     * @return array Response
     */
    public function getOne($referenceName) {
        assert(
            is_string($referenceName),
            new \RuntimeException(
                sprintf('Parameter "$referenceName" should be a string. (%s)', $referenceName)
            )
        );

        return $this->sendGet(
            sprintf('/profiles/%s/references/%s', $this->userName, $referenceName)
        );
    }

    /**
     * Updates a reference given its slug.
     *
     * @param string $referenceName
     * @param string $value
     *
     * @return array Response
     */
    public function updateOne($referenceName, $value) {
        assert(
            is_string($referenceName),
            new \RuntimeException(
                sprintf('Parameter "$referenceName" should be a string. (%s)', $referenceName)
            )
        );
        assert(
            is_string($value),
            new \RuntimeException(
                sprintf('Parameter "$value" should be a string. (%s)', $value)
            )
        );

        return $this->sendPatch(
            sprintf('/profiles/%s/references/%s', $this->userName, $referenceName),
            [],
            [
                'value'     => $value
            ]
        );
    }

    /**
     * Deletes a reference given its slug.
     *
     * @param string $referenceName
     *
     * @return array Response
     */
    public function deleteOne($referenceName) {
        assert(
            is_string($referenceName),
            new \RuntimeException(
                sprintf('Parameter "$referenceName" should be a string. (%s)', $referenceName)
            )
        );

        return $this->sendDelete(
            sprintf('/profiles/%s/references/%s', $this->userName, $referenceName)
        );
    }

    /**
     * Deletes all references.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function deleteAll(array $filters = []) {
        return $this->sendDelete(
            sprintf('/profiles/%s/references', $this->userName),
            $filters
        );
    }
}
