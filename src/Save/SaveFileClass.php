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
     * Stores instances of the object
     * @var instance
     */
    private static $instance;

    /**
     * Create a configured instance to use the SaveFileClass service.
     */
    public function __construct()
    {
        if (!self::$instance) {
            self::$instance = $this;
            //echo "Create new object";
            return self::$instance;
        } else {
            //echo "Return old object";
            return self::$instance;
        }
    }

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
