Package ParserRssAtom
================

[![Build Status](http://img.shields.io/travis/prusmarcin/parser-rss-atom.svg)](https://travis-ci.org/prusmarcin/parser-rss-atom)
[![Total Downloads](http://img.shields.io/packagist/dm/prusmarcin/parser-rss-atom.svg)](https://packagist.org/packages/prusmarcin/parser-rss-atom)
[![Latest Stable Version](http://img.shields.io/packagist/v/prusmarcin/parser-rss-atom.svg)](https://packagist.org/packages/prusmarcin/parser-rss-atom)
[![License](http://img.shields.io/badge/license-MIT-lightgrey.svg)](https://github.com/prusmarcin/parser-rss-atom/blob/master/LICENSE)


:package_description

- [Installation](#installation)
- [Usage](#usage)
- [Commands](#commands)
- [Information](#information)
- [Testing](#testing)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)


Installation
------------

Add the prusmarcin/parserRssAtom package to your `composer.json` file.

``` json
{
    "require": {
        "prusmarcin/parser-rss-atom": "0.*"
    }
}
```

Or via the command line in the root of your application installation.

``` bash
$ composer require "prusmarcin/parser-rss-atom:0.*"
```

Usage
-----

``` php
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
} else {}

```


Commands
-------

Use onlny by CLI: Windows CMD, Unix Shell

``` bash
$ php src/console.php csv:simple http://feeds.nationalgeographic.com/ng/News/News_Main eksport_prosty.csv
```

OR

``` bash
$ php src/console.php csv:extended http://feeds.nationalgeographic.com/ng/News/News_Main eksport_prosty.csv
```
Result array

``` php
Array
(
    [0] => Array
        (
            [info] => 1
            [message] => Success - The file export_prosty.csv was saved in the root directory of the application.
        )

)

```

Information
-----------

A csv file is written to the disk. The columns are separated by a `Tab`.


Testing
-------

``` bash
$ phpunit
```


Contributing
------------

Please see [CONTRIBUTING](https://github.com/prusmarcin/parserRssAtom/blob/master/CONTRIBUTING.md) for details.


Credits
-------

- [Sammy Kaye Powers](https://github.com/prusmarcin)
- [All Contributors](https://github.com/prusmarcin/parserRssAtom/contributors)


License
-------

The MIT License (MIT). Please see [License File](https://github.com/prusmarcin/parserRssAtom/blob/master/LICENSE) for more information.
