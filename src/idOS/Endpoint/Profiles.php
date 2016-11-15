<?php

namespace idOS\Endpoint;

/**
 * Profiles Class Endpoint.
 */
class Profiles extends AbstractEndpoint {
    /**
     * Lists all Profiles.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function listAll(array $filters = []) {
        return $this->sendGet(
            '/profiles',
            $filters
        );
    }
}
