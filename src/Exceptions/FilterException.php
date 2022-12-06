<?php

namespace WeDesignIt\Sendy\Exceptions;

class FilterException extends \Exception
{

    public function __construct($message = '', $code = 0, \Throwable $previous = null)
    {
        $message = 'Bad filter argument: ' . $message;
        parent::__construct($message, $code, $previous);
    }

}