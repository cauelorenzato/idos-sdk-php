<?php

namespace idOS\Auth;

/**
 * Abstract Auth extensible for all Auth Classes.
 */
abstract class AbstractAuth implements AuthInterface {
    public function __toString() {
        $name = get_class($this);
        $name = substr($name, (strrpos($name, '\\') + 1));

        return sprintf('%s %s', $name, $this->getToken());
    }
}
