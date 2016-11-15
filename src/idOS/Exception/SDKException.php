<?php

namespace idOS\Exception;

class SDKException extends \Exception {
    protected $type;

    protected $link;

    protected $message;

    public function __construct(
        $message,
        $type,
        $link
    ) {
        $this->message = $message;
        $this->type    = $type;
        $this->link    = $link;
    }
}
