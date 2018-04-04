<?php
require __DIR__ . '/../vendor/autoload.php';

use MarcinPrus\Parser\ParserClass as Parser;
use MarcinPrus\Save\SaveFileClass as Save;

if (isset($argc) && isset($argv)) {
    $parser = new Parser();
    $parser->requestMethod = 'curl';
    $parser->run();
    $parser->parseCliParameters($argc, $argv);

    $save = new Save();
    $save->fileType = $parser->fileType;
    $response = $save->toFile(
        $parser->path, $parser->saveOption, $parser->parseContent()
    );

    echo "\n";
//    echo "fileType:".$parser->fileType."\n";
//    echo "saveOption:".$parser->saveOption."\n";
//    echo "url:".$parser->url."\n";
//    echo "path:".$parser->path."\n";
} else {
    echo 'Zmienna $argc i $argv nie istnieja';
    //trzeba poczytac jeszcze o register_argc_argv
}



