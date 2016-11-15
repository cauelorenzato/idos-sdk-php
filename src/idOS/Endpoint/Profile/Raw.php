<?php

namespace idOS\Endpoint\Profile;

/**
 * Raw Class Endpoint.
 */
class Raw extends AbstractProfileEndpoint {
    /**
     * Creates a new raw data for the given source.
     *
     * @param int    $sourceId
     * @param string $collectionName
     * @param array  $data
     *
     * @return array Response
     */
    public function createNew(
        $sourceId,
        $collectionName,
        array $data
    ) {
        assert(
            is_int($sourceId),
            new \RuntimeException(
                sprintf('Parameter "$sourceId" should be a int. (%s)', $sourceId)
            )
        );

        assert(
            is_string($collectionName),
            new \RuntimeException(
                sprintf('Parameter "$collectionName" should be a string. (%s)', $collectionName)
            )
        );

        return $this->sendPost(
            sprintf('/profiles/%s/raw', $this->userName),
            [],
            [
                'source_id'  => $sourceId,
                'collection' => $collectionName,
                'data'       => $data
            ]
        );
    }

    /**
     * Tries to update a raw data and if it doesnt exists, creates a new raw data.
     *
     * @param int    $sourceId
     * @param string $collectionName
     * @param array  $data
     *
     * @return array Response
     */
    public function upsertOne(
        $sourceId,
        $collectionName,
        array $data
    ) {
        assert(
            is_int($sourceId),
            new \RuntimeException(
                sprintf('Parameter "$sourceId" should be a int. (%s)', $sourceId)
            )
        );

        assert(
            is_string($collectionName),
            new \RuntimeException(
                sprintf('Parameter "$collectionName" should be a string. (%s)', $collectionName)
            )
        );

        return $this->sendPut(
            sprintf('/profiles/%s/raw', $this->userName),
            [],
            [
                'source_id'  => $sourceId,
                'collection' => $collectionName,
                'data'       => $data
            ]
        );
    }

    /**
     * Lists all raw data.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function listAll(array $filters = []) {
        return $this->sendGet(
            sprintf('/profiles/%s/raw', $this->userName),
            $filters
        );
    }

    public function deleteAll(array $filters = []) {
        return $this->sendDelete(
            sprintf('/profiles/%s/raw', $this->userName),
            $filters
        );
    }
}
