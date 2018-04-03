<?php
namespace MarcinPrus\Save;

abstract class SaveAbstract
{

    /**
     * Method save data to file As CSV format
     *
     * @param string $fileName - name of file
     * @param string $saveOption - simple or extended option
     * @param array $items - array of objects data from rss
     * @return Return string.
     */
    protected function SaveAsCsv(string $fileName, string $saveOption, $items = array()): string
    {
        $first_line = "title\tdescription\tlink\tpubDate\tcreator";
        $content = '';

        if ($saveOption == 'simple') {
            $content .= $first_line . "\n";
        }

        if ($saveOption == 'extended') {
            if (!file_exists($fileName)) {
                $content .= $first_line . "\n";
            }
        }

        foreach ($items as $item) {
            $content .= $item->title . "\t"
                . $item->description . "\t"
                . $item->link . "\t"
                . $item->pubDate . "\t"
                . $item->creator . "\n";
        }

        if ($saveOption == 'simple') {
            $fh = fopen($fileName, "w");
            fwrite($fh, $content);
            fclose($fh);
        }

        if ($saveOption == 'extended') {
            $fh = fopen($fileName, "a");
            fwrite($fh, $content);
            fclose($fh);
        }

        return 'Sukces - Wszystkie dane pomyslnie zostaly zapisane do pliku ' . $fileName;
    }

    /**
     * Method save data to file As TXT format
     *
     * @param string $fileName - name of file
     * @param string $saveOption - simple or extended option
     * @param array $items - array of objects data from rss
     * @return Return string.
     */
    protected function SaveAsTxt(string $fileName, string $saveOption, $items = array()): string
    {
        
    }

    /**
     * Method save data to file As SQL format
     *
     * @param string $fileName - name of file
     * @param string $saveOption - simple or extended option
     * @param array $items - array of objects data from rss
     * @return Return string.
     */
    protected function SaveAsSql(string $fileName, string $saveOption, $items = array()): string
    {
        
    }
}
