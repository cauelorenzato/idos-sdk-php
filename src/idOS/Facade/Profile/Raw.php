<?php

namespace idOS\Facade\Profile;

use GuzzleHttp\Client;
use idOS\Auth;
use idOS\Endpoint\Raw as RawEndpoint;

class Raw {
    /**
     * Returns the raw instance or, creates a new one if it doesn't exists yet and returns it.
     *
     * @param string $userName
     * @param Auth   $auth
     *
     * @return Raw instance
     */
    private static function getInstance(
        $userName,
        Auth $auth
    ) {
        return new RawEndpoint(
            $userName,
            $auth,
            new Client()
        );
    }

    /**
     * Creates a new instance of Raw.
     *
     * @param string $userName
     * @param int    $sourceId
     * @param string $collectionName
     * @param array  $data
     * @param Auth   $auth
     *
     * @return array response
     */
    public static function createNew(
        $userName,
        $sourceId,
        $collectionName,
        array $data,
        Auth $auth
    ) {
        return static::getInstance()
            ->createNew($sourceId, $collectionName, $data);
    }

    /**
     * Lists all raws.
     *
     * @param string $userName [description]
     * @param Auth   $auth     [description]
     * @param array  $filters  [description]
     *
     * @return array response
     */
    public static function listAll(
        $userName,
        Auth $auth,
        array $filters = []
    ) {
        return static::getInstance()
            ->listAll($filters);
    }
}
