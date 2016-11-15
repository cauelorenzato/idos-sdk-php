<?php

namespace idOS\Auth;

/**
 * None Authorization Class.
 */
class None extends AbstractAuth {
    /**
     *  Constructor Class.
     */
    public function __construct() {
    }

    /**
     * Returns an empty string.
     */
    public function getToken() {
        return '';
    }
}
