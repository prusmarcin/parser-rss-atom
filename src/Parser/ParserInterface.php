<?php

namespace MarcinPrus\Parser;

interface ParserInterface
{  
    public function parseCliParameters(int $argc, array $argv): bool;
    
    public function parseContent(): array;
}

