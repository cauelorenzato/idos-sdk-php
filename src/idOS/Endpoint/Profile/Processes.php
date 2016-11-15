<?php

namespace idOS\Endpoint\Profile;

/**
 * Processes Class Endpoint.
 */
class Processes extends AbstractProfileEndpoint {
    /**
     * Lists all processes.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function listAll(array $filters = []) {
        return $this->sendGet(
            sprintf('/profiles/%s/processes', $this->userName),
            $filters
        );
    }

    /**
     * Retrieves a processe given its slug.
     *
     * @param int $processId
     *
     * @return array Response
     */
    public function getOne($processId) {
        assert(
            is_int($processId),
            new \RuntimeException(
                sprintf('Parameter "$processId" should be a int. (%s)', $processId)
            )
        );

        return $this->sendGet(
            sprintf('/profiles/%s/processes/%s', $this->userName, $processId)
        );
    }
}
