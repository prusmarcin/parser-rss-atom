<?php

namespace MarcinPrus\Parser;

use MarcinPrus\Message\MessageClass as Message;

/**
 * This class has a task to have block the whole script if it is not running in the console
 */
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
            Message::displayError(array([
                'error' => true,
                'message' => 'Skrypt dziala tylko w trybie CLI'
            ]));
            die('');
        }
    }
}

