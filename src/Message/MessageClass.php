<?php

namespace MarcinPrus\Message;

/**
 * Display all messages/communications from aplication
 */
class MessageClass
{
    /**
     * Static Method display error 
     *
     * @param array $error - information about error
     */
    public static function displayError(array $error)
    {
        print_r($error);
    }
    
    /**
     * Static Method display Positive Information, Tips 
     *
     * @param array $info - information, tips
     */
    public static function displayInfo(array $info)
    {
        print_r($info);
    }
}

