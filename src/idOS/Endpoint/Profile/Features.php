<?php

namespace idOS\Endpoint\Profile;

/**
 * Features Class Endpoint.
 */
class Features extends AbstractProfileEndpoint {
    private function typeInfer($value) {
        if (is_float($value)) {
            return 'double';
        }

        if (is_integer($value)) {
            return 'integer';
        }

        if (is_bool($value)) {
            return 'boolean';
        }

        if (is_array($value)) {
            return 'array';
        }

        return 'string';
    }

    /**
     * Creates a new feature for the given user.
     *
     * @param int        $sourceId
     * @param string     $name
     * @param mixed      $value
     * @param mixed|null $type
     *
     * @return array Response
     */
    public function createNew(
        $sourceId,
        $name,
        $value,
        $type = null
    ) {
        if ($type === null) {
            $type = $this->typeInfer($value);
        }

        assert(
            is_int($sourceId),
            new \RuntimeException(
                sprintf('Parameter "$sourceId" should be a int. (%s)', $sourceId)
            )
        );
        assert(
            is_string($name),
            new \RuntimeException(
                sprintf('Parameter "$name" should be a string. (%s)', $name)
            )
        );

        return $this->sendPost(
            sprintf('/profiles/%s/features', $this->userName),
            [],
            [
                'source_id' => $sourceId,
                'name'      => $name,
                'value'     => $value,
                'type'      => $type
            ]
        );
    }

    /**
     * Tries to update a feature and if it doesnt exists, creates a new feature.
     *
     * @param int        $sourceId
     * @param string     $name
     * @param mixed      $value
     * @param mixed|null $type
     *
     * @return array Response
     */
    public function upsertOne(
        $sourceId,
        $name,
        $value,
        $type = null
    ) {
        if ($type === null) {
            $type = $this->typeInfer($value);
        }

        assert(
            is_int($sourceId),
            new \RuntimeException(
                sprintf('Parameter "$sourceId" should be a int. (%s)', $sourceId)
            )
        );
        assert(
            is_string($name),
            new \RuntimeException(
                sprintf('Parameter "$name" should be a string. (%s)', $name)
            )
        );

        return $this->sendPut(
            sprintf('/profiles/%s/features', $this->userName),
            [],
            [
                'source_id' => $sourceId,
                'name'      => $name,
                'value'     => $value,
                'type'      => $type
            ]
        );
    }

    /**
     * Creates or Updates more than one feature
     *
     * @param  array  $features
     *
     * @return array Response
     */
    public function upsertBulk(array $features) {
        foreach ($features as &$feature) {
            if (empty($feature['type'])) {
                $feature['type'] = $this->typeInfer($feature['value']);
            }
        }

        return $this->sendPut(
            sprintf('/profiles/%s/features/bulk', $this->userName),
            [],
            $features
        );
    }

    /**
     * Lists all features.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function listAll(array $filters = []) {
        return $this->sendGet(
            sprintf('/profiles/%s/features', $this->userName),
            $filters
        );
    }

    /**
     * Retrieves a feature given its slug.
     *
     * @param int $featureId
     *
     * @return array Response
     */
    public function getOne($featureId) {
        assert(
            is_int($featureId),
            new \RuntimeException(
                sprintf('Parameter "$featureId" should be a int. (%s)', $featureId)
            )
        );
        return $this->sendGet(
            sprintf('/profiles/%s/features/%s', $this->userName, $featureId)
        );
    }

    /**
     * Updates a feature given its slug.
     *
     * @param string $featureId
     * @param mixed  $value
     * @param string $type
     *
     * @return array Response
     */
    public function updateOne($featureId, $value, $type) {
        assert(
            is_int($featureId),
            new \RuntimeException(
                sprintf('Parameter "$featureId" should be a int. (%s)', $featureId)
            )
        );

        return $this->sendPatch(
            sprintf('/profiles/%s/features/%s', $this->userName, $featureId),
            [],
            [
                'value' => $value,
                'type'  => $type
            ]
        );
    }

    /**
     * Deletes a feature given its slug.
     *
     * @param int $featureId
     *
     * @return array Response
     */
    public function deleteOne($featureId) {
        assert(
            is_int($featureId),
            new \RuntimeException(
                sprintf('Parameter "$featureId" should be a int. (%s)', $featureId)
            )
        );
        return $this->sendDelete(
            sprintf('/profiles/%s/features/%s', $this->userName, $featureId)
        );
    }

    /**
     * Deletes all features.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function deleteAll(array $filters = []) {
        return $this->sendDelete(
            sprintf('/profiles/%s/features', $this->userName),
            $filters
        );
    }
}
