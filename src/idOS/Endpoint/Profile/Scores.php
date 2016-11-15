<?php

namespace idOS\Endpoint\Profile;

/**
 * Scores Class Endpoint.
 */
class Scores extends AbstractProfileEndpoint {
    /**
     * Creates a new score for the given source.
     *
     * @param string $attribute
     * @param string $name
     * @param float  $value
     *
     * @return array Response
     */
    public function createNew(
        $attribute,
        $name,
        $value
    ) {
        assert(
            is_string($attribute),
            new \RuntimeException(
                sprintf('Parameter "$attribute" should be a string. (%s)', $attribute)
            )
        );
        assert(
            is_string($name),
            new \RuntimeException(
                sprintf('Parameter "$name" should be a string. (%s)', $name)
            )
        );
        assert(
            is_float($value),
            new \RuntimeException(
                sprintf('Parameter "$value" should be a float. (%s)', $value)
            )
        );

        return $this->sendPost(
            sprintf('/profiles/%s/scores', $this->userName),
            [],
            [
                'attribute' => $attribute,
                'name'      => $name,
                'value'     => $value
            ]
        );
    }

    /**
     * Tries to update a score and if it doesnt exists, creates a new score.
     *
     * @param string $attribute
     * @param string $name
     * @param float  $value
     *
     * @return array Response
     */
    public function upsertOne(
        $attribute,
        $name,
        $value
    ) {
        assert(
            is_string($attribute),
            new \RuntimeException(
                sprintf('Parameter "$attribute" should be a string. (%s)', $attribute)
            )
        );
        assert(
            is_string($name),
            new \RuntimeException(
                sprintf('Parameter "$name" should be a string. (%s)', $name)
            )
        );
        assert(
            is_float($value),
            new \RuntimeException(
                sprintf('Parameter "$value" should be a float. (%s)', $value)
            )
        );

        return $this->sendPut(
            sprintf('/profiles/%s/scores', $this->userName),
            [],
            [
                'attribute' => $attribute,
                'name'      => $name,
                'value'     => $value
            ]
        );
    }

    /**
     * Lists all scores.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function listAll(array $filters = []) {
        return $this->sendGet(
            sprintf('/profiles/%s/scores', $this->userName),
            $filters
        );
    }

    /**
     * Retrieves the score given its name.
     *
     * @param string $name
     *
     * @return
     */
    public function getOne($name) {
        assert(
            is_string($name),
            new \RuntimeException(
                sprintf('Parameter "$name" should be a string. (%s)', $name)
            )
        );

        return $this->sendGet(
            sprintf('/profiles/%s/scores/%s', $this->userName, $name)
        );
    }

    /**
     * Updates a score in the given profile.
     *
     * @param string $attribute
     * @param string $name
     * @param float  $value
     *
     * @return array Response
     */
    public function updateOne($attribute, $name, $value) {
        assert(
            is_string($attribute),
            new \RuntimeException(
                sprintf('Parameter "$attribute" should be a string. (%s)', $attribute)
            )
        );
        assert(
            is_string($name),
            new \RuntimeException(
                sprintf('Parameter "$name" should be a string. (%s)', $name)
            )
        );
        assert(
            is_float($value),
            new \RuntimeException(
                sprintf('Parameter "$value" should be a float. (%s)', $value)
            )
        );

        return $this->sendPatch(
            sprintf('/profiles/%s/scores/%s', $this->userName, $name),
            [],
            [
                'attribute' => $attribute,
                'value'     => $value
            ]
        );
    }

    /**
     * Deletes a score given its name.
     *
     * @param string $name
     *
     * @return array Response
     */
    public function deleteOne($name) {
        assert(
            is_string($name),
            new \RuntimeException(
                sprintf('Parameter "$name" should be a string. (%s)', $name)
            )
        );

        return $this->sendDelete(
            sprintf('/profiles/%s/scores/%s', $this->userName, $name)
        );
    }

    /**
     * Deletes all scores for the given username.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function deleteAll(array $filters = []) {
        return $this->sendDelete(
            sprintf('/profiles/%s/scores', $this->userName),
            $filters
        );
    }
}
