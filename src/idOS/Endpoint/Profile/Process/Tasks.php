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
        $success,
        $message
    ) {

        return $this->sendPost(
            sprintf('/profiles/%s/processes/%s/tasks', $this->userName, $this->processId),
            [],
            [
                'name'    => $name,
                'event'   => $event,
                'running' => $running,
                'success' => $success,
                'message' => $message
            ]
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
        $success,
        $message
    ) {
        return $this->sendPatch(
            sprintf('/profiles/%s/processes/%s/tasks/%s', $this->userName, $this->processId, $taskId),
            [],
            [
                'name'    => $name,
                'event'   => $event,
                'running' => $running,
                'success' => $success,
                'message' => $message
            ]
        );
    }
}
