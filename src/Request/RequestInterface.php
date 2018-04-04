<?php

namespace MarcinPrus\Request;

/**
 * Method used to download content from RSS/Atom
 */
interface RequestInterface
{

    /**
     * Submit the request with the specified parameters.
     *
     * @param $url Request parameters
     * @return true if is success or return false if is error
     */
    public function submit(string $url): bool;
}

