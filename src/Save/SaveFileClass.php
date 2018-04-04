<?php
namespace MarcinPrus\Save;

use MarcinPrus\Message\MessageClass as Message;

/**
 * Save all data from application to file
 */
class SaveFileClass extends SaveAbstract
{

    /**
     * Have value 'csv' 
     * @var fileType
     */
    public $fileType = null;

    /**
     * Method call function to save data in file
     *
     * @param string $fileName - name of file
     * @param string $saveOption - simple or extended option
     * @param array $items - array of object data from rss
     * @return Return string.
     */
    public function ToFile(string $fileName, string $saveOption, $items = array()): bool
    {
        if (empty($items)) {
            //nic nie rob jesli tablica jest pusta to nie ma sensu zapisywac do pliku
            Message::displayInfo(array([
                'info' => true,
                'message' => 'Nie ma danych do zapisu wiec plik nie zostal utworzony'
            ]));
            return false;
        } else {
            if ($this->fileType == 'csv') {
                Message::displayInfo(array([
                'info' => true,
                'message' => $this->SaveAsCsv($fileName, $saveOption, $items)
            ]));
                return true;
            }
        }
    }
}
