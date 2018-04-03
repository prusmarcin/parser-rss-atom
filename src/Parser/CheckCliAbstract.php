<?php

namespace MarcinPrus\Parser;

abstract class CheckCliAbstract
{
    /**
     * Method check CLI mode 
     *
     * @return Return false or true.
     */
    public function run()
    {
        if ('cli' != php_sapi_name()) {
            //throw new Exception('This has to be run from the command line');
            //$this->_displayError('Skrypt dziala tylko w trybie CLI');
            die('Skrypt dziala tylko w trybie CLI');
        }
    }
}

