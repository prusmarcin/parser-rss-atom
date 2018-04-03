<?php
namespace MarcinPrus\Save;

class SaveFileClass extends SaveAbstract
{

    public $fileType = null;

    /**
     * Method call function to save data in file
     *
     * @param string $fileName - name of file
     * @param string $saveOption - simple or extended option
     * @param array $items - array of object data from rss
     * @return Return string.
     */
    public function ToFile(string $fileName, string $saveOption, $items = array()): string
    {
        if ($this->fileType == 'csv') {
            return $this->SaveAsCsv($fileName, $saveOption, $items);
        }
    }
}
