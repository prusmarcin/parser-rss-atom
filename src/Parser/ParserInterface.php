<?php

namespace MarcinPrus\Parser;

/**
 * Methods used to parse data.
 */
interface ParserInterface
{  
    /**
     * Method parse commands entered by user in CLI
     *
     * @param int $argc - count arguments
     * @param array $argv - all entered arguments from user
     * @return Return true if parse arguments is without error or false if is error.
     */
    public function parseCliParameters(int $argc, array $argv): bool;
    
    /**
     * Method parse RSS/Atom
     *
     * @return Return array of objects or if is error return empty array
     */
    public function parseContent(): array;
}

