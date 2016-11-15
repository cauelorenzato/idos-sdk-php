<?php

namespace idOS\Endpoint\Profile;

/**
 * Gates Class Endpoint.
 */
class Gates extends AbstractProfileEndpoint {
    /**
     * Creates a new gate for the given user.
     *
     * @param string $name
     * @param bool   $pass
     *
     * @return array Response
     */
    public function createNew(
        $name,
        $pass
    ) {
        assert(
            is_string($name),
            new \RuntimeException(
                sprintf('Parameter "$name" should be a string. (%s)', $name)
            )
        );
        assert(
            is_bool($pass),
            new \RuntimeException(
                sprintf('Parameter "$pass" should be a boolean. (%s)', $pass)
            )
        );

        return $this->sendPost(
            sprintf('/profiles/%s/gates', $this->userName),
            [],
            [
                'name'      => $name,
                'pass'      => $pass
            ]
        );
    }

    /**
     * Tries to update a gate and if it doesnt exists, creates a new gate.
     *
     * @param string $name
     * @param bool   $pass
     *
     * @return array Response
     */
    public function upsertOne(
        $name,
        $pass
    ) {
        assert(
            is_string($name),
            new \RuntimeException(
                sprintf('Parameter "$name" should be a string. (%s)', $name)
            )
        );
        assert(
            is_bool($pass),
            new \RuntimeException(
                sprintf('Parameter "$pass" should be a boolean. (%s)', $pass)
            )
        );

        return $this->sendPut(
            sprintf('/profiles/%s/gates', $this->userName),
            [],
            [
                'name'      => $name,
                'pass'      => $pass
            ]
        );
    }

    /**
     * Lists all gates.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function listAll(array $filters = []) {
        return $this->sendGet(
            sprintf('/profiles/%s/gates', $this->userName),
            $filters
        );
    }

    /**
     * Retrieves a gate given its slug.
     *
     * @param string $gateSlug
     *
     * @return array Response
     */
    public function getOne($gateSlug) {
        assert(
            is_string($gateSlug),
            new \RuntimeException(
                sprintf('Parameter "$gateSlug" should be a string. (%s)', $gateSlug)
            )
        );

        return $this->sendGet(
            sprintf('/profiles/%s/gates/%s', $this->userName, $gateSlug)
        );
    }

    /**
     * Updates a gate given its slug.
     *
     * @param string $gateSlug
     * @param bool $pass
     *
     * @return array Response
     */
    public function updateOne($gateSlug, $pass) {
        assert(
            is_string($gateSlug),
            new \RuntimeException(
                sprintf('Parameter "$gateSlug" should be a string. (%s)', $gateSlug)
            )
        );
        assert(
            is_bool($pass),
            new \RuntimeException(
                sprintf('Parameter "$pass" should be a boolean. (%s)', $pass)
            )
        );

        return $this->sendPatch(
            sprintf('/profiles/%s/gates/%s', $this->userName, $gateSlug),
            [],
            [
                'pass'     => $pass
            ]
        );
    }

    /**
     * Deletes a gate given its slug.
     *
     * @param string $gateSlug
     *
     * @return array Response
     */
    public function deleteOne($gateSlug) {
        assert(
            is_string($gateSlug),
            new \RuntimeException(
                sprintf('Parameter "$gateSlug" should be a string. (%s)', $gateSlug)
            )
        );

        return $this->sendDelete(
            sprintf('/profiles/%s/gates/%s', $this->userName, $gateSlug)
        );
    }

    /**
     * Deletes all gates.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function deleteAll(array $filters = []) {
        return $this->sendDelete(
            sprintf('/profiles/%s/gates', $this->userName),
            $filters
        );
    }
}
