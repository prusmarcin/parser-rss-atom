<?php

namespace MarcinPrus\Request;

use MarcinPrus\Message\MessageClass as Message;

/**
 * Make request to RSS/Atom by file_get_contents() PHP function.
 * @see http://php.net/manual/en/function.file-get-contents.php
 */
class FgcClass implements RequestInterface
{

    /**
     * Submit by file_get_contents().
     *
     * @param $url parameters
     * @return true if is success or return false if is error
     */
    public function submit(string $url): bool
    {
        //some code
    }
}
