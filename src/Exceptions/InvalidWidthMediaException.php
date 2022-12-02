<?php

namespace App\Exceptions;

use Throwable;

class InvalidWidthMediaException extends \Exception
{
    public function __construct($message = "Invalid width", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}