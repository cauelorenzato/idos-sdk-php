<?php

namespace idOS\Endpoint\Profile\Process;

/**
 * Tasks Class Endpoint.
 */
class Tasks extends AbstractProcessEndpoint {
    /**
     * Creates a new task for the given user.
     *
     * @param string $name
     * @param string $event
     * @param bool   $running
     * @param bool   $success
     * @param string $message
     *
     * @return array Response
     */
    public function createNew(
        $name,
        $event,
        $running,
        $success = null,
        $message = ''
    ) {
        assert(
            is_string($name),
            new \RuntimeException(
                sprintf('Parameter "$name" should be a string. (%s)', $name)
            )
        );
        assert(
            is_string($event),
            new \RuntimeException(
                sprintf('Parameter "$event" should be a string. (%s)', $event)
            )
        );

        $array = [
            'name'    => $name,
            'event'   => $event,
            'running' => $running
        ];

        if (! empty($message)) {
            $array['message'] = $message;
        }

        if ($success !== null) {
            assert(
                is_bool($success),
                new \RuntimeException(
                    sprintf('Parameter "$success" should be a bool. (%s)', $success)
                )
            );

            $array['success'] = $success;
        }

        return $this->sendPost(
            sprintf('/profiles/%s/processes/%s/tasks', $this->userName, $this->processId),
            [],
            $array
        );
    }

    /**
     * Lists all tasks.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function listAll(array $filters = []) {
        return $this->sendGet(
            sprintf('/profiles/%s/processes/%s/tasks', $this->userName, $this->processId),
            $filters
        );
    }

    /**
     * Retrieves a task given its slug.
     *
     * @param int $taskId
     *
     * @return array Response
     */
    public function getOne($taskId) {
        assert(
            is_int($taskId),
            new \RuntimeException(
                sprintf('Parameter "$taskId" should be a string. (%s)', $taskId)
            )
        );

        return $this->sendGet(
            sprintf('/profiles/%s/processes/%s/tasks/%s', $this->userName, $this->processId, $taskId)
        );
    }

    /**
     * Updates a task given its slug.
     *
     * @param int    $taskId
     * @param mixed  $value
     * @param string $type
     *
     * @return array Response
     */
    public function updateOne(
        $taskId,
        $name,
        $event,
        $running,
        $success = null,
        $message = ''
    ) {
        assert(
            is_int($taskId),
            new \RuntimeException(
                sprintf('Parameter "$taskId" should be a string. (%s)', $taskId)
            )
        );
        assert(
            is_string($name),
            new \RuntimeException(
                sprintf('Parameter "$name" should be a string. (%s)', $name)
            )
        );
        assert(
            is_string($event),
            new \RuntimeException(
                sprintf('Parameter "$event" should be a string. (%s)', $event)
            )
        );
        assert(
            is_bool($running),
            new \RuntimeException(
                sprintf('Parameter "$running" should be a bool. (%s)', $running)
            )
        );

        $array = [
            'name'    => $name,
            'event'   => $event,
            'running' => $running
        ];

        if (! empty($message)) {
            $array['message'] = $message;
        }

        if ($success !== null) {
            assert(
                is_bool($success),
                new \RuntimeException(
                    sprintf('Parameter "$success" should be a bool. (%s)', $success)
                )
            );

            $array['success'] = $success;
        }

        return $this->sendPatch(
            sprintf('/profiles/%s/processes/%s/tasks/%s', $this->userName, $this->processId, $taskId),
            [],
            $array
        );
    }
}
