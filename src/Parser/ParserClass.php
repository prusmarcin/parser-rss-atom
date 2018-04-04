<?php
namespace MarcinPrus\Parser;

use MarcinPrus\Request;
use MarcinPrus\Message\MessageClass as Message;

/**
 * Parse all data in this application
 */
class ParserClass extends CheckCliAbstract implements ParserInterface
{

    /**
     * Have value csv
     * @var fileType
     */
    public $fileType = null;

    /**
     * Have value simple or extended
     * @var saveOption
     */
    public $saveOption = null;

    /**
     * Have url to RSS/Atom
     * @var url
     */
    private $url = null;

    /**
     * Have file name and extension
     * @var path
     */
    public $path = null;

    /**
     * Have 'curl' or other methods
     * @var requestMethod
     */
    public $requestMethod = null; //`curl` or `file_get_contents`

    /**
     * Stores instances of the object
     * @var instance
     */
    private static $instance;

    /**
     * Create a configured instance to use the ParserClass service.
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
     * Method validate CLI parameters
     *
     * @param string $fileType - what is ext file
     * @param string $saveOption - way save data to file
     * @param string $url - url to parse
     * @param string $path - file name with ext
     * @return Return false or true.
     */
    private function _validateCliParameters(string $fileType, string $saveOption, string $url, string $path): bool
    {

        if ($fileType != 'csv') {
            Message::displayError(array([
                    'error' => true,
                    'message' => 'Wymagana flaga csv: wprowadz csv:simple lub csv:extended'
            ]));
            /* $this->_displayError(array([
              'error' => true,
              'message' => 'Wymagana flaga csv: wprowadz csv:simple lub csv:extended'
              ])); */
            return false;
        }

        if (($saveOption != 'simple') && ($saveOption != 'extended')) {
            Message::displayError(array([
                    'error' => true,
                    'message' => 'Moze byc wprowadzony tylko typ simple lub extended'
            ]));
            return false;
        }

        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            Message::displayError(array([
                    'error' => true,
                    'message' => 'Wprowadzony URL nie jest poprawny'
            ]));
            return false;
        }

        $path_parts = pathinfo($path);
        if (!isset($path_parts['extension'])) {
            Message::displayError(array([
                    'error' => true,
                    'message' => 'Popraw ostatni parametr - nazwe pliku'
            ]));
            return false;
        }

        return true;
    }

    /**
     * Method parse parameters that user entered by CLI
     *
     * @param int $argc Predefined Variables - The number of arguments passed to script
     * @param array $argv Predefined Variables - Array of arguments passed to script
     * @return Return false or true.
     */
    public function parseCliParameters(int $argc, array $argv): bool
    {
        //jesli parametry sa podane poprawnie to bedzie ich 4
        if ($argc != 4) {
            Message::displayError(array([
                    'error' => true,
                    'message' => 'Zle wprowadzone parametry: php [file] [type] [url] [path]'
            ]));
            return false;
        } else {
            //print_r($argv);
            if (!isset($argv[0])) {
                return false;
            }
            if (!isset($argv[1])) {
                return false;
            }
            if (!isset($argv[2])) {
                return false;
            }
            if (!isset($argv[3])) {
                return false;
            }

            //przypisz jesli parametrow jest 4

            $secondParameter = explode(':', $argv[1]); //na wejscie 'csv:simple'

            if (!isset($secondParameter[0]) || !isset($secondParameter[1])) {
                return false;
            }

            $fileType = $secondParameter[0]; //przyjmnie wartosc 'csv
            $saveOption = $secondParameter[1]; //przyjmnie wartosc 'simple' lub 'extended'
            $url = $argv[2]; //przyjmnie url do RSS/Atom
            $path = $argv[3]; //przyjmie np. plik.csv

            if ($this->_validateCliParameters($fileType, $saveOption, $url, $path)) {

                $this->fileType = $fileType;
                $this->saveOption = $saveOption;
                $this->url = $url;
                $this->path = $path;

                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Method parse content from RSS/Atom
     *
     * @return Return array().
     */
    public function parseContent(): array
    {
        $tabObj = array();

        if ($this->requestMethod == 'curl') {

            $curl = new Request\CurlClass();
            $curl->submit($this->url);

            if ($curl->isSuccess() === false) {
                Message::displayError($curl->getErrorCodes());
            } else {
                $content = $curl->getResponse();

                if (preg_match_all('#<item>(.*?)</item>#is', $content, $result)) {

                    foreach ($result[0] as $item) {
                        $xmlTitle = '';
                        $xmlDescription = '';
                        $xmlLink = '';
                        $xmlPubDate = '';
                        $xmlCreator = '';

                        if (preg_match('#<title>(.*?)</title>#is', $item, $title)) {
                            $xmlTitle = $title[1];
                            $xmlTitle = html_entity_decode($xmlTitle);
                            $xmlTitle = strip_tags($xmlTitle);
                        }

                        if (preg_match('#<description>(.*?)</description>#is', $item, $description)) {
                            $xmlDescription = $description[1];
                            $xmlDescription = html_entity_decode($xmlDescription);
                            $xmlDescription = strip_tags($xmlDescription);
                            //$xmlDescription = preg_replace("/<img[^>]+\>/i", "", $xmlDescription);
                        }

                        if (preg_match('#<link>(.*?)</link>#is', $item, $link)) {
                            $xmlLink = $link[1];
                            $xmlLink = html_entity_decode($xmlLink);
                            $xmlLink = strip_tags($xmlLink);
                        }

                        if (preg_match('#<pubDate>(.*?)</pubDate>#is', $item, $pubDate)) {
                            $xmlPubDate = $pubDate[1];
                            $xmlPubDate = html_entity_decode($xmlPubDate);
                            $xmlPubDate = strip_tags($xmlPubDate);
                            $xmlPubDate = date("Y-m-d H:i:s", strtotime($xmlPubDate));
                        }

                        if (preg_match('#<dc:creator>(.*?)</dc:creator>#is', $item, $creator)) {
                            $xmlCreator = $creator[1];
                            $xmlCreator = html_entity_decode($xmlCreator);
                            $xmlCreator = strip_tags($xmlCreator);
                        }

                        $xml = new \stdClass();
                        $xml->title = $xmlTitle;
                        $xml->description = $xmlDescription;
                        $xml->link = $xmlLink;
                        $xml->pubDate = $xmlPubDate;
                        $xml->creator = $xmlCreator;

                        $tabObj[] = $xml;
                    }
                } else {
                    
                }
            } //end if else isSuccess
        } // end if requestMethod == 'curl'

        return $tabObj;
    }
    /* Magic method */

    public function __get($name)
    {
        return $this->$name;
    }
}
